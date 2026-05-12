<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\PerformanceCalculationService;
use App\Models\AiPerformanceSnapshot;
use App\Models\AiKkmSetting;
use App\Models\AiBenchmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends Controller
{
    protected $calcService;
    protected $gamificationService;

    public function __construct(
        PerformanceCalculationService $calcService, 
        \App\Services\GamificationService $gamificationService
    ) {
        $this->calcService = $calcService;
        $this->gamificationService = $gamificationService;
    }

    public function index(Request $request)
    {
        // Asumsi: Kita ambil ID siswa dari sesi login Moodle
        $userId = session('moodle_user.id', 2); // Default ID 2 untuk testing
        
        // Ambil semua course Moodle yang diikuti oleh user ini
        $enrolledCourseIds = DB::connection('moodle')->table('user_enrolments as ue')
            ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
            ->where('ue.userid', $userId)
            ->pluck('e.courseid')
            ->toArray();

        // Tentukan Course ID untuk data (dari request)
        $courseId = $request->input('course_id'); 
        
        if (!$courseId) {
            // Cerdas: Cari Course di mana siswa tersebut terakhir kali mengerjakan kuis
            $latestAttempt = DB::connection('moodle')->table('quiz_attempts as qa')
                ->join('quiz as q', 'q.id', '=', 'qa.quiz')
                ->where('qa.userid', $userId)
                ->where('qa.state', 'finished')
                ->orderBy('qa.timestart', 'desc')
                ->first();
                
            if ($latestAttempt) {
                $courseId = $latestAttempt->course;
            } else {
                $courseId = !empty($enrolledCourseIds) ? $enrolledCourseIds[0] : 1;
            }
        }

        // 0. Gamification Audit (Growth Hat-trick, dll)
        $this->gamificationService->checkAndAwardBadges($userId, $courseId);

        // 1. Hitung ulang mastery score terbaru
        $masteryData = $this->calcService->calculateUserMastery($userId, $courseId);
        
        // 2. Sinkronisasi Snapshot (Growth)
        $this->calcService->syncPerformanceSnapshot($userId, $courseId);
        $snapshot = AiPerformanceSnapshot::where('user_id', $userId)->where('course_id', $courseId)->first();

        // 3. Ambil KKM & Benchmark untuk status Excellent/Alert
        $kkm = AiKkmSetting::where('course_id', $courseId)->first();
        $benchmark = AiBenchmark::where('course_id', $courseId)->first();

        // 4. Cari tahu asal sekolah dari kursus ini
        // Kita periksa SEMUA course yang diikuti siswa untuk menemukan sekolahnya
        $schoolFromCourse = DB::table('ai_school_courses')
            ->join('ai_schools', 'ai_schools.id', '=', 'ai_school_courses.school_id')
            ->whereIn('ai_school_courses.moodle_course_id', !empty($enrolledCourseIds) ? $enrolledCourseIds : [0])
            ->select('ai_schools.school_name')
            ->first();

        if ($schoolFromCourse) {
            $schoolName = $schoolFromCourse->school_name;
        } else {
            // Cek prioritas kedua: Dari relasi kelas (fallback)
            $school = DB::table('ai_classes')
                ->join('ai_schools', 'ai_schools.id', '=', 'ai_classes.school_id')
                ->whereIn('ai_classes.moodle_course_id', !empty($enrolledCourseIds) ? $enrolledCourseIds : [0])
                ->select('ai_schools.school_name')
                ->first();
                
            $schoolName = $school ? $school->school_name : 'Platform AI Learning';
        }

        $user = session('moodle_user');

        return view('student.dashboard', compact('masteryData', 'snapshot', 'kkm', 'benchmark', 'schoolName', 'user'));
    }

    public function excellentScores(Request $request)
    {
        if (!session('moodle_user')) return redirect()->route('moodle.login');
        $userId = session('moodle_user')['id'];
        
        // 1. Ambil nilai rata-rata per kategori soal (menggunakan service kalkulator kita)
        $latestAttempt = DB::connection('moodle')->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'desc')
            ->first();
            
        $courseId = $latestAttempt ? $latestAttempt->course : 1;
        
        // Ambil pemetaan lengkap beserta kodenya
        $mappings = DB::table('ai_competency_mapping')
            ->join('ai_competencies', 'ai_competencies.id', '=', 'ai_competency_mapping.competency_id')
            ->whereIn('ai_competencies.course_id', [$courseId, 1])
            ->select('ai_competency_mapping.moodle_category_id', 'ai_competencies.topic_code')
            ->get();

        $mapelScores = [];

        foreach ($mappings as $mapping) {
            // Hitung nilai siswa untuk kategori ini
            $score = DB::connection('moodle')
                ->table('question_attempts as qa')
                ->join('question_attempt_steps as qas', 'qa.id', '=', 'qas.questionattemptid')
                ->join('question_versions as qv', 'qa.questionid', '=', 'qv.questionid')
                ->join('question_bank_entries as qbe', 'qv.questionbankentryid', '=', 'qbe.id')
                ->join('quiz_attempts as quiza', 'qa.questionusageid', '=', 'quiza.uniqueid')
                ->where('quiza.userid', $userId)
                ->where('quiza.state', 'finished')
                ->where('qbe.questioncategoryid', $mapping->moodle_category_id)
                ->whereNotNull('qas.fraction')
                ->avg('qas.fraction');

            if ($score !== null) {
                // Ekstrak Kode Mapel (Misal: dari MATSD-SULIT-A06 menjadi MATSD)
                $codeParts = explode('-', $mapping->topic_code);
                $mapelCode = $codeParts[0];

                if (!isset($mapelScores[$mapelCode])) {
                    $mapelScores[$mapelCode] = ['total' => 0, 'count' => 0];
                }
                $mapelScores[$mapelCode]['total'] += ($score * 100);
                $mapelScores[$mapelCode]['count']++;
            }
        }

        $excellentData = [];
        $benchmark = \App\Models\AiBenchmark::where('course_id', $courseId)->first();
        $targetSchool = $benchmark->target_school ?? 75;

        foreach ($mapelScores as $mapelCode => $data) {
            $avgScore = $data['total'] / $data['count'];
            
            if ($avgScore >= $targetSchool) {
                // Cari nama panjang mapel dari Topik Master (misal MATSD -> Matematika)
                $masterTopic = DB::table('ai_competencies')->where('topic_code', $mapelCode)->first();
                $mapelName = $masterTopic ? $masterTopic->topic_name : $mapelCode;

                $excellentData[$mapelName] = [
                    'score' => $avgScore,
                    'target' => $targetSchool
                ];
            }
        }

        return view('student.excellent_scores', compact('excellentData'));
    }

    public function growthDetails(Request $request)
    {
        if (!session('moodle_user')) return redirect()->route('moodle.login');
        $userId = session('moodle_user')['id'];

        $latestAttempt = DB::connection('moodle')->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'desc')
            ->first();

        $courseId = $latestAttempt ? $latestAttempt->course : 1;

        $snapshot = \App\Models\AiPerformanceSnapshot::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        $growthData = [];
        $mapelName = 'Matematika';

        if ($snapshot) {
            $growth = $snapshot->growth_percentage ?? 0;
            $status = $growth >= 10 ? 'EXCELLENT' : ($growth > 0 ? 'GOOD' : 'BAD');
            $growthData[] = [
                'mapel' => $mapelName,
                'growth' => $growth,
                'status' => $status,
                'baseline' => $snapshot->baseline_score,
                'current' => $snapshot->current_score,
            ];
        }

        return view('student.growth_details', compact('growthData'));
    }

    public function alertScores(Request $request)
    {
        if (!session('moodle_user')) return redirect()->route('moodle.login');
        $userId = session('moodle_user')['id'];

        $latestAttempt = DB::connection('moodle')->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'desc')
            ->first();

        $courseId = $latestAttempt ? $latestAttempt->course : 1;

        $mappings = DB::table('ai_competency_mapping')
            ->join('ai_competencies', 'ai_competencies.id', '=', 'ai_competency_mapping.competency_id')
            ->whereIn('ai_competencies.course_id', [$courseId, 1])
            ->select('ai_competency_mapping.moodle_category_id', 'ai_competencies.topic_code', 'ai_competencies.topic_name')
            ->get();

        $kkmSetting = \App\Models\AiKkmSetting::where('course_id', $courseId)->first();
        $kkmScore = $kkmSetting->min_score ?? 70;

        // Ambil quiz info untuk nama & tanggal
        $quizInfo = DB::connection('moodle')->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'desc')
            ->select('q.name', 'qa.timestart')
            ->first();

        $quizName = $quizInfo->name ?? '-';
        $quizDate = $quizInfo ? date('d M Y', $quizInfo->timestart) : '-';

        $alertData = [];

        foreach ($mappings as $mapping) {
            $score = DB::connection('moodle')
                ->table('question_attempts as qa')
                ->join('question_attempt_steps as qas', 'qa.id', '=', 'qas.questionattemptid')
                ->join('question_versions as qv', 'qa.questionid', '=', 'qv.questionid')
                ->join('question_bank_entries as qbe', 'qv.questionbankentryid', '=', 'qbe.id')
                ->join('quiz_attempts as quiza', 'qa.questionusageid', '=', 'quiza.uniqueid')
                ->where('quiza.userid', $userId)
                ->where('quiza.state', 'finished')
                ->where('qbe.questioncategoryid', $mapping->moodle_category_id)
                ->whereNotNull('qas.fraction')
                ->avg('qas.fraction');

            if ($score !== null) {
                $pct = $score * 100;
                if ($pct < $kkmScore) {
                    $codeParts = explode('-', $mapping->topic_code);
                    $mapelCode = $codeParts[0];

                    if (!isset($alertData[$mapelCode])) {
                        $masterTopic = DB::table('ai_competencies')
                            ->where('topic_code', $mapelCode)->first();
                        $alertData[$mapelCode] = [
                            'name' => $masterTopic ? $masterTopic->topic_name : $mapelCode,
                            'total' => 0,
                            'count' => 0,
                            'quiz_name' => $quizName,
                            'quiz_date' => $quizDate,
                            'kkm' => $kkmScore,
                        ];
                    }
                    $alertData[$mapelCode]['total'] += $pct;
                    $alertData[$mapelCode]['count']++;
                }
            }
        }

        return view('student.alert_scores', compact('alertData'));
    }

    public function topicAlerts(Request $request)
    {
        if (!session('moodle_user')) return redirect()->route('moodle.login');
        $userId = session('moodle_user')['id'];

        $latestAttempt = DB::connection('moodle')->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'desc')
            ->first();

        $courseId = $latestAttempt ? $latestAttempt->course : 1;

        $kkmSetting = \App\Models\AiKkmSetting::where('course_id', $courseId)->first();
        $kkmScore = $kkmSetting->min_score ?? 70;

        $mappings = DB::table('ai_competency_mapping')
            ->join('ai_competencies', 'ai_competencies.id', '=', 'ai_competency_mapping.competency_id')
            ->whereIn('ai_competencies.course_id', [$courseId, 1])
            ->select('ai_competency_mapping.moodle_category_id', 'ai_competencies.topic_code', 'ai_competencies.topic_name')
            ->get();

        $quizInfo = DB::connection('moodle')->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'desc')
            ->select('q.name as quiz_name', 'qa.timestart')
            ->first();

        $topicAlerts = [];
        $seenTopics = [];

        foreach ($mappings as $mapping) {
            $score = DB::connection('moodle')
                ->table('question_attempts as qa')
                ->join('question_attempt_steps as qas', 'qa.id', '=', 'qas.questionattemptid')
                ->join('question_versions as qv', 'qa.questionid', '=', 'qv.questionid')
                ->join('question_bank_entries as qbe', 'qv.questionbankentryid', '=', 'qbe.id')
                ->join('quiz_attempts as quiza', 'qa.questionusageid', '=', 'quiza.uniqueid')
                ->where('quiza.userid', $userId)
                ->where('quiza.state', 'finished')
                ->where('qbe.questioncategoryid', $mapping->moodle_category_id)
                ->whereNotNull('qas.fraction')
                ->avg('qas.fraction');

            if ($score !== null) {
                $pct = $score * 100;
                if ($pct < $kkmScore) {
                    $topicName = $mapping->topic_name;
                    if (isset($seenTopics[$topicName])) continue;
                    $seenTopics[$topicName] = true;

                    $codeParts = explode('-', $mapping->topic_code);
                    $mapelCode = $codeParts[0];
                    $masterTopic = DB::table('ai_competencies')
                        ->where('topic_code', $mapelCode)->first();
                    $mapelName = $masterTopic ? $masterTopic->topic_name : $mapelCode;

                    $topicAlerts[] = [
                        'quiz_name' => $quizInfo->quiz_name ?? '-',
                        'quiz_date' => $quizInfo ? date('d M Y', $quizInfo->timestart) : '-',
                        'mapel' => $mapelName,
                        'topic' => $topicName,
                        'score' => round($pct, 1),
                        'kkm' => $kkmScore,
                    ];
                }
            }
        }

        return view('student.topic_alerts', compact('topicAlerts'));
    }
}
