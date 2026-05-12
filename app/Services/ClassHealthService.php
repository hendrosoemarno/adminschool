<?php

namespace App\Services;

use App\Models\AiPerformanceSnapshot;
use App\Models\AiKkmSetting;
use App\Models\AiClass;
use Illuminate\Support\Facades\DB;

class ClassHealthService
{
    /**
     * Menghitung Skor Kesehatan Kelas untuk Dashboard Wali Kelas
     */
    public function calculateClassHealth($classId, $courseId)
    {
        $class = AiClass::find($classId);
        if (!$class) return 0;
        
        // 1. Dapatkan daftar ID siswa di kelas ini dari Moodle
        $studentIds = DB::connection('moodle')
            ->table('user_info_data')
            ->where('data', $class->class_name)
            ->pluck('userid');

        if ($studentIds->isEmpty()) return 0;

        // 2. Partisipasi (40%)
        // Berapa banyak siswa yang sudah mengerjakan minimal 1 kuis di course ini
        $participatedCount = DB::connection('moodle')
            ->table('quiz_attempts')
            ->whereIn('userid', $studentIds)
            ->where('course', $courseId)
            ->distinct('userid')
            ->count();
        
        $participationRate = ($participatedCount / $studentIds->count()) * 100;

        // 3. Rata-rata Kompetensi (40%)
        // Diambil dari snapshot yang sudah dihitung sebelumnya
        $avgMastery = AiPerformanceSnapshot::whereIn('user_id', $studentIds)
            ->where('course_id', $courseId)
            ->avg('current_score') ?? 0;

        // 4. Laju Intervensi (Siswa di bawah KKM) (20%)
        $kkm = AiKkmSetting::where('school_id', $class->school_id)
            ->where('course_id', $courseId)
            ->first()->min_score ?? 75;

        $belowKkmCount = AiPerformanceSnapshot::whereIn('user_id', $studentIds)
            ->where('course_id', $courseId)
            ->where('current_score', '<', $kkm)
            ->count();
        
        $interventionRate = ($belowKkmCount / $studentIds->count()) * 100;

        // RUMUS FINAL
        $healthScore = ($participationRate * 0.4) + ($avgMastery * 0.4) - ($interventionRate * 0.2);

        return round(max(0, min(100, $healthScore)), 2);
    }
}
