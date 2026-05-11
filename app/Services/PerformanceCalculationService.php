<?php

namespace App\Services;

use App\Models\AiPerformanceSnapshot;
use App\Models\AiCompetencyMapping;
use Illuminate\Support\Facades\DB;

class PerformanceCalculationService
{
    /**
     * Menghitung Mastery Score per Kompetensi untuk seorang siswa
     * Logic: Membedah skor kuis hingga level kategori soal (Moodle question_attempts)
     */
    public function calculateUserMastery($userId, $courseId)
    {
        // 1. Ambil semua kategori yang sudah dipetakan untuk course ini (TERMASUK TOPIK GLOBAL DARI COURSE 1)
        // Kita gunakan DB Join agar tidak terjebak masalah relasi dinamis pada whereHas Eloquent
        $mappings = DB::table('ai_competency_mapping')
            ->join('ai_competencies_reguler', 'ai_competencies_reguler.id', '=', 'ai_competency_mapping.competency_id')
            ->where('ai_competency_mapping.mapping_type', 'reguler')
            ->whereIn('ai_competencies_reguler.course_id', [$courseId, 1])
            ->select('ai_competency_mapping.*', 'ai_competencies_reguler.topic_name')
            ->get();

        $results = [];

        foreach ($mappings as $mapping) {
            // 2. Hitung rata-rata skor siswa khusus untuk soal-soal di kategori ini
            // Kita join mdl_quiz_attempts -> mdl_question_attempts -> mdl_question
            // Perbaikan kompatibilitas Moodle 4.0+ dengan tambahan statistik soal
            $prefix = DB::connection('moodle')->getTablePrefix();
            
            $stats = DB::connection('moodle')
                ->table('question_attempts as qa')
                ->join('question_attempt_steps as qas', 'qa.id', '=', 'qas.questionattemptid')
                ->join('question_versions as qv', 'qa.questionid', '=', 'qv.questionid')
                ->join('question_bank_entries as qbe', 'qv.questionbankentryid', '=', 'qbe.id')
                ->join('quiz_attempts as quiza', 'qa.questionusageid', '=', 'quiza.uniqueid')
                ->where('quiza.userid', $userId)
                ->where('quiza.state', 'finished')
                ->where('qbe.questioncategoryid', $mapping->moodle_category_id)
                ->whereNotNull('qas.fraction') // Skor dalam bentuk 0.0 sampai 1.0
                ->select(DB::raw("count({$prefix}qas.fraction) as total_questions, sum({$prefix}qas.fraction) as correct_answers, avg({$prefix}qas.fraction) as avg_score"))
                ->first();

            $totalQuestions = $stats->total_questions ?? 0;
            $correctAnswers = $stats->correct_answers ?? 0;
            $score = $stats->avg_score ?? 0;

            $topicName = $mapping->topic_name ?? 'Topik ' . $mapping->competency_id;
            
            // Jika topik yang sama muncul dari beberapa kategori, kita akumulasikan statistik soalnya
            if (isset($results[$topicName])) {
                $results[$topicName]['total_questions'] += $totalQuestions;
                $results[$topicName]['correct_answers'] += $correctAnswers;
                // Hitung ulang persentasenya agar akurat
                if ($results[$topicName]['total_questions'] > 0) {
                    $results[$topicName]['score'] = ($results[$topicName]['correct_answers'] / $results[$topicName]['total_questions']) * 100;
                }
            } else {
                $results[$topicName] = [
                    'score' => $score * 100,
                    'total_questions' => $totalQuestions,
                    'correct_answers' => $correctAnswers
                ];
            }
        }

        return $results;
    }

    /**
     * Update Snapshot Performa (Growth & Mastery)
     */
    public function syncPerformanceSnapshot($userId, $courseId)
    {
        $firstAttempt = DB::connection('moodle')
            ->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('q.course', $courseId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'asc')
            ->select('qa.*', 'q.sumgrades as max_grade')
            ->first();

        // Ambil nilai kuis terakhir (Current)
        $lastAttempt = DB::connection('moodle')
            ->table('quiz_attempts as qa')
            ->join('quiz as q', 'q.id', '=', 'qa.quiz')
            ->where('qa.userid', $userId)
            ->where('q.course', $courseId)
            ->where('qa.state', 'finished')
            ->orderBy('qa.timestart', 'desc')
            ->select('qa.*', 'q.sumgrades as max_grade')
            ->first();

        if ($firstAttempt && $lastAttempt) {
            $baselineMax = $firstAttempt->max_grade > 0 ? $firstAttempt->max_grade : 1;
            $currentMax = $lastAttempt->max_grade > 0 ? $lastAttempt->max_grade : 1;

            $baseline = ($firstAttempt->sumgrades / $baselineMax) * 100;
            $current = ($lastAttempt->sumgrades / $currentMax) * 100;
            $growth = $current - $baseline;

            // Simpan ke Cache Snapshot
            AiPerformanceSnapshot::updateOrCreate(
                ['user_id' => $userId, 'course_id' => $courseId],
                [
                    'baseline_score' => $baseline,
                    'current_score' => $current,
                    'growth_percentage' => $growth,
                    // Logika Hat-trick bisa ditambahkan di sini dengan mengecek histori
                ]
            );
        }
    }
}
