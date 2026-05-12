<?php

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;
use App\Models\AiSchool;
use App\Models\AiCompetency;
use App\Models\AiPerformanceSnapshot;
use App\Models\AiKkmSetting;
use App\Models\AiBenchmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrincipalDashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = session('moodle_user.id');
        $school = AiSchool::where('principal_name', $userId)->first();
        if (!$school) {
            return view('principal.dashboard', ['error' => 'Sekolah tidak ditemukan untuk akun Anda.']);
        }
        $schoolId = $school->id;

        $courseIds = DB::table('ai_school_courses')
            ->where('school_id', $schoolId)
            ->pluck('moodle_course_id')
            ->toArray();
        if (empty($courseIds)) $courseIds = [1];
        $selectedCourseId = $request->input('course_id', $courseIds[0]);

        $classes = DB::table('ai_classes')
            ->where('school_id', $schoolId)
            ->whereNotNull('moodle_course_id')
            ->get();

        // --- Performance Index ---
        $enrolledUserIds = DB::connection('moodle')->table('user_enrolments as ue')
            ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
            ->whereIn('e.courseid', $courseIds)
            ->distinct()
            ->pluck('ue.userid')
            ->toArray();

        $snapshots = AiPerformanceSnapshot::whereIn('user_id', $enrolledUserIds)->get();
        $totalStudents = $snapshots->count();

        $benchmark = AiBenchmark::where('school_id', $schoolId)->whereIn('course_id', $courseIds)->first();
        $targetSchool = $benchmark->target_school ?? 75;
        $kkmSetting = AiKkmSetting::where('school_id', $schoolId)->whereIn('course_id', $courseIds)->first();
        $kkmScore = $kkmSetting->min_score ?? 70;

        $excellentCount = $snapshots->where('current_score', '>=', $targetSchool)->count();
        $alertCount = $snapshots->where('current_score', '<', $kkmScore)->count();
        $excellentRate = $totalStudents > 0 ? round(($excellentCount / $totalStudents) * 100) : 0;
        $alertRate = $totalStudents > 0 ? round(($alertCount / $totalStudents) * 100) : 0;
        $avgMastery = $totalStudents > 0 ? round($snapshots->avg('current_score'), 1) : 0;

        // --- Growth per Mapel (Line Chart) ---
        $trendLabels = [];
        $trendDatasets = [];
        $subjectHasTrend = false;

        $subjectNames = ['MATSD' => 'Matematika', 'BINSD' => 'Bahasa Indonesia'];
        $quizSubjectMap = [425 => 'MATSD', 426 => 'BINSD'];
        $subjectAttemptsByNumber = []; // [code => [attemptNumber => [scores...]]]
        $userSubjectGrowth = [];

        foreach ($enrolledUserIds as $uid) {
            if ($uid <= 2) continue;
            $attempts = DB::connection('moodle')->table('quiz_attempts as qa')
                ->join('quiz as q', 'q.id', '=', 'qa.quiz')
                ->where('qa.userid', $uid)->where('qa.state', 'finished')
                ->whereIn('qa.quiz', array_keys($quizSubjectMap))
                ->orderBy('qa.timestart')
                ->select('qa.quiz', 'qa.sumgrades', 'q.sumgrades as max_grade')->get();

            foreach ($attempts as $a) {
                $code = $quizSubjectMap[$a->quiz] ?? 'UNKNOWN';
                $pct = $a->max_grade > 0 ? ($a->sumgrades / $a->max_grade) * 100 : 0;
                if (!isset($subjectAttemptsByNumber[$code])) $subjectAttemptsByNumber[$code] = [];
                $subjectAttemptsByNumber[$code][] = $pct;
            }
        }

        // Hitung rata-rata per attempt ke-n per mapel
        // Tentukan max attempt dari data sebenarnya (bukan dari jumlah entry)
        $maxAttempts = DB::connection('moodle')->table('quiz_attempts')
            ->whereIn('quiz', array_keys($quizSubjectMap))
            ->where('state', 'finished')
            ->max('attempt') ?? 0;
        $maxAttempts = min($maxAttempts, 5);

        $colors = ['rgba(79, 70, 229, 0.8)', 'rgba(5, 150, 105, 0.8)'];
        $colorIdx = 0;
        foreach ($subjectAttemptsByNumber as $code => $allScores) {
            $subjectAvg = [];
            for ($i = 1; $i <= $maxAttempts; $i++) {
                // Ambil attempt ke-i dari setiap user
                $scoresAtI = [];
                foreach ($enrolledUserIds as $uid) {
                    if ($uid <= 2) continue;
                    $userScores = [];
                    $attemptsForUser = DB::connection('moodle')->table('quiz_attempts as qa')
                        ->join('quiz as q', 'q.id', '=', 'qa.quiz')
                        ->where('qa.userid', $uid)->where('qa.state', 'finished')
                        ->where('qa.quiz', array_search($code, $quizSubjectMap))
                        ->orderBy('qa.timestart')
                        ->select('qa.sumgrades', 'q.sumgrades as max_grade')
                        ->get();
                    foreach ($attemptsForUser as $afu) {
                        $userScores[] = $afu->max_grade > 0 ? ($afu->sumgrades / $afu->max_grade) * 100 : 0;
                    }
                    if (isset($userScores[$i - 1])) {
                        $scoresAtI[] = $userScores[$i - 1];
                    }
                }
                $subjectAvg[] = count($scoresAtI) > 0 ? round(array_sum($scoresAtI) / count($scoresAtI), 1) : 0;
            }

            $trendDatasets[] = [
                'label' => $subjectNames[$code] ?? $code,
                'data' => $subjectAvg,
                'borderColor' => $colors[$colorIdx % count($colors)],
                'backgroundColor' => str_replace('0.8', '0.1', $colors[$colorIdx % count($colors)]),
            ];
            $colorIdx++;
        }

        $trendLabels = [];
        for ($i = 1; $i <= $maxAttempts; $i++) {
            $trendLabels[] = 'Ke-' . $i;
        }
        $subjectHasTrend = $maxAttempts >= 2;

        // Rata-rata growth (selisih attempt terakhir - pertama)
        $avgGrowth = 0;
        $growthCount = 0;
        foreach ($trendDatasets as $ds) {
            $first = $ds['data'][0] ?? 0;
            $last = $ds['data'][count($ds['data']) - 1] ?? 0;
            if ($maxAttempts >= 2) {
                $avgGrowth += ($last - $first);
                $growthCount++;
            }
        }
        $avgGrowth = $growthCount > 0 ? round($avgGrowth / $growthCount, 1) : 0;

        // --- Subject Heatmap ---
        $subjects = AiCompetency::where('type', 'pelajaran')->where('jenjang', $school->jenjang)->get();
        $subjectStats = [];
        foreach ($subjects as $sub) {
            $prefix = $sub->topic_code;
            $totalScore = 0; $totalExc = 0; $sc = 0;
            foreach ($enrolledUserIds as $uid) {
                if ($uid <= 2) continue;
                $snap = $snapshots->firstWhere('user_id', $uid);
                if (!$snap) continue;
                $calcService = app(\App\Services\PerformanceCalculationService::class);
                $masteryData = $calcService->calculateUserMastery($uid, $snap->course_id);
                $total = 0; $count = 0;
                foreach ($masteryData as $topic => $d) {
                    $codeParts = explode('-', $d['topic_code'] ?? '');
                    if (($codeParts[0] ?? '') === $prefix) { $total += $d['score']; $count++; }
                }
                if ($count > 0) {
                    $avgTopic = $total / $count;
                    $totalScore += $avgTopic;
                    if ($avgTopic >= $targetSchool) $totalExc++;
                    $sc++;
                }
            }
            $subjectStats[] = [
                'name' => $sub->topic_name, 'code' => $sub->topic_code,
                'students' => $sc, 'avg_score' => $sc > 0 ? round($totalScore / $sc, 1) : 0,
                'excellent_rate' => $sc > 0 ? round(($totalExc / $sc) * 100) : 0,
            ];
        }

        // --- Matriks Komparatif Antar Kelas ---
        $classMatrix = [];
        foreach ($classes as $class) {
            $classUserIds = DB::connection('moodle')->table('user_enrolments as ue')
                ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
                ->where('e.courseid', $class->moodle_course_id)
                ->distinct()->pluck('ue.userid')->toArray();
            $classSnapshots = $snapshots->whereIn('user_id', $classUserIds);
            $count = $classSnapshots->count();
            $avg = $count > 0 ? round($classSnapshots->avg('current_score'), 1) : 0;
            // Growth per mapel: rata-rata growth per mapel per siswa
            $totalGrowth = 0; $gCount = 0;
            foreach ($classUserIds as $cuid) {
                if (isset($userSubjectGrowth[$cuid])) {
                    foreach ($userSubjectGrowth[$cuid] as $code => $g) {
                        $totalGrowth += $g;
                        $gCount++;
                    }
                }
            }
            $growth = $gCount > 0 ? round($totalGrowth / $gCount, 1) : 0;
            $exc = $classSnapshots->where('current_score', '>=', $targetSchool)->count();
            $excRate = $count > 0 ? round(($exc / $count) * 100) : 0;
            $classMatrix[] = [
                'name' => $class->class_name, 'students' => $count,
                'avg_score' => $avg, 'growth' => $growth, 'excellent_rate' => $excRate,
            ];
        }

        return view('principal.dashboard', compact(
            'school', 'totalStudents', 'excellentRate', 'alertRate',
            'avgMastery', 'avgGrowth', 'targetSchool', 'kkmScore',
            'subjectStats', 'classMatrix', 'trendLabels', 'trendDatasets', 'subjectHasTrend',
            'excellentCount', 'alertCount'
        ));
    }

    public function studentMastery(Request $request)
    {
        $userId = session('moodle_user.id');
        $school = AiSchool::where('principal_name', $userId)->first();
        if (!$school) return view('principal.student_mastery', ['error' => 'Sekolah tidak ditemukan.']);
        $schoolId = $school->id;

        $subjects = AiCompetency::where('type', 'pelajaran')->where('jenjang', $school->jenjang)->get();
        $courseIds = DB::table('ai_school_courses')->where('school_id', $schoolId)->pluck('moodle_course_id')->toArray();
        if (empty($courseIds)) $courseIds = [1];

        $enrolledUserIds = DB::connection('moodle')->table('user_enrolments as ue')
            ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
            ->whereIn('e.courseid', $courseIds)->distinct()->pluck('ue.userid')->toArray();

        $snapshots = AiPerformanceSnapshot::whereIn('user_id', $enrolledUserIds)->get()->keyBy('user_id');

        $students = [];
        foreach ($enrolledUserIds as $uid) {
            if ($uid <= 2) continue;
            $user = DB::connection('moodle')->table('user')->where('id', $uid)->select('id','firstname','lastname','username')->first();
            if (!$user) continue;
            $snap = $snapshots->get($uid);
            if (!$snap) continue;

            $userCourseIds = DB::connection('moodle')->table('user_enrolments as ue')
                ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
                ->where('ue.userid', $uid)->whereIn('e.courseid', $courseIds)->pluck('e.courseid')->toArray();
            $className = '-';
            foreach ($userCourseIds as $ucId) {
                $class = DB::table('ai_classes')->where('moodle_course_id', $ucId)->where('school_id', $schoolId)->first();
                if ($class) { $className = $class->class_name; break; }
            }

            $subjectScores = [];
            $calcService = app(\App\Services\PerformanceCalculationService::class);
            $masteryData = $calcService->calculateUserMastery($uid, $snap->course_id);
            foreach ($subjects as $sub) {
                $prefix = $sub->topic_code; $total = 0; $count = 0;
                foreach ($masteryData as $topic => $d) {
                    $codeParts = explode('-', $d['topic_code'] ?? '');
                    if (($codeParts[0] ?? '') === $prefix) { $total += $d['score']; $count++; }
                }
                $subjectScores[$sub->topic_name] = $count > 0 ? round($total / $count, 1) : '-';
            }

            $students[] = ['name' => $user->firstname . ' ' . $user->lastname, 'class' => $className, 'subjectScores' => $subjectScores];
        }

        return view('principal.student_mastery', compact('school', 'subjects', 'students'));
    }

    public function excellentStudents(Request $request)
    {
        $userId = session('moodle_user.id');
        $school = AiSchool::where('principal_name', $userId)->first();
        if (!$school) return view('principal.excellent_students', ['error' => 'Sekolah tidak ditemukan.']);
        $schoolId = $school->id;

        $subjects = AiCompetency::where('type', 'pelajaran')->where('jenjang', $school->jenjang)->get();
        $courseIds = DB::table('ai_school_courses')->where('school_id', $schoolId)->pluck('moodle_course_id')->toArray();
        if (empty($courseIds)) $courseIds = [1];

        $enrolledUserIds = DB::connection('moodle')->table('user_enrolments as ue')
            ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
            ->whereIn('e.courseid', $courseIds)->distinct()->pluck('ue.userid')->toArray();

        $snapshots = AiPerformanceSnapshot::whereIn('user_id', $enrolledUserIds)->get()->keyBy('user_id');

        $students = [];
        foreach ($enrolledUserIds as $uid) {
            if ($uid <= 2) continue;
            $user = DB::connection('moodle')->table('user')->where('id', $uid)->select('id','firstname','lastname')->first();
            if (!$user) continue;
            $snap = $snapshots->get($uid);
            if (!$snap || ($snap->current_score ?? 0) < 75) continue;

            $userCourseIds = DB::connection('moodle')->table('user_enrolments as ue')
                ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
                ->where('ue.userid', $uid)->whereIn('e.courseid', $courseIds)->pluck('e.courseid')->toArray();
            $className = '-';
            foreach ($userCourseIds as $ucId) {
                $class = DB::table('ai_classes')->where('moodle_course_id', $ucId)->where('school_id', $schoolId)->first();
                if ($class) { $className = $class->class_name; break; }
            }

            $subjectScores = [];
            $calcService = app(\App\Services\PerformanceCalculationService::class);
            $masteryData = $calcService->calculateUserMastery($uid, $snap->course_id);
            foreach ($subjects as $sub) {
                $prefix = $sub->topic_code; $total = 0; $count = 0;
                foreach ($masteryData as $topic => $d) {
                    $codeParts = explode('-', $d['topic_code'] ?? '');
                    if (($codeParts[0] ?? '') === $prefix) { $total += $d['score']; $count++; }
                }
                $subjectScores[$sub->topic_name] = $count > 0 ? round($total / $count, 1) : '-';
            }

            $students[] = ['name' => $user->firstname . ' ' . $user->lastname, 'class' => $className, 'subjectScores' => $subjectScores];
        }

        return view('principal.excellent_students', compact('school', 'subjects', 'students'));
    }

    public function alertStudents(Request $request)
    {
        $userId = session('moodle_user.id');
        $school = AiSchool::where('principal_name', $userId)->first();
        if (!$school) return view('principal.alert_students', ['error' => 'Sekolah tidak ditemukan.']);
        $schoolId = $school->id;

        $subjects = AiCompetency::where('type', 'pelajaran')->where('jenjang', $school->jenjang)->get();
        $courseIds = DB::table('ai_school_courses')->where('school_id', $schoolId)->pluck('moodle_course_id')->toArray();
        if (empty($courseIds)) $courseIds = [1];

        $enrolledUserIds = DB::connection('moodle')->table('user_enrolments as ue')
            ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
            ->whereIn('e.courseid', $courseIds)->distinct()->pluck('ue.userid')->toArray();

        $snapshots = AiPerformanceSnapshot::whereIn('user_id', $enrolledUserIds)->get()->keyBy('user_id');

        $students = [];
        foreach ($enrolledUserIds as $uid) {
            if ($uid <= 2) continue;
            $user = DB::connection('moodle')->table('user')->where('id', $uid)->select('id','firstname','lastname')->first();
            if (!$user) continue;
            $snap = $snapshots->get($uid);
            if (!$snap || ($snap->current_score ?? 0) >= 70) continue;

            $userCourseIds = DB::connection('moodle')->table('user_enrolments as ue')
                ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
                ->where('ue.userid', $uid)->whereIn('e.courseid', $courseIds)->pluck('e.courseid')->toArray();
            $className = '-';
            foreach ($userCourseIds as $ucId) {
                $class = DB::table('ai_classes')->where('moodle_course_id', $ucId)->where('school_id', $schoolId)->first();
                if ($class) { $className = $class->class_name; break; }
            }

            $subjectScores = [];
            $calcService = app(\App\Services\PerformanceCalculationService::class);
            $masteryData = $calcService->calculateUserMastery($uid, $snap->course_id);
            foreach ($subjects as $sub) {
                $prefix = $sub->topic_code; $total = 0; $count = 0;
                foreach ($masteryData as $topic => $d) {
                    $codeParts = explode('-', $d['topic_code'] ?? '');
                    if (($codeParts[0] ?? '') === $prefix) { $total += $d['score']; $count++; }
                }
                $subjectScores[$sub->topic_name] = $count > 0 ? round($total / $count, 1) : '-';
            }

            $students[] = ['name' => $user->firstname . ' ' . $user->lastname, 'class' => $className, 'subjectScores' => $subjectScores];
        }

        return view('principal.alert_students', compact('school', 'subjects', 'students'));
    }
}
