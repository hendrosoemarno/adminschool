<?php

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;
use App\Models\AiSchool;
use App\Models\AiPerformanceSnapshot;
use App\Models\AiKkmSetting;
use App\Models\AiBenchmark;
use Illuminate\Http\Request;

class PrincipalDashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil ID Sekolah (asumsi dari profil Kepsek yang login)
        $schoolId = $request->input('school_id', 1); // Default sekolah 1
        $school = AiSchool::find($schoolId);
        $courseId = $request->input('course_id', 1);

        // 2. Kalkulasi Statistik Sekolah (Excellent vs Alert)
        $benchmark = AiBenchmark::where('school_id', $schoolId)->where('course_id', $courseId)->first();
        $targetScore = $benchmark->target_school ?? 75;

        $excellentCount = AiPerformanceSnapshot::where('course_id', $courseId)
            ->where('current_score', '>=', $targetScore)
            ->count();

        $kkm = AiKkmSetting::where('school_id', $schoolId)->where('course_id', $courseId)->first();
        $minScore = $kkm->min_score ?? 70;

        $alertCount = AiPerformanceSnapshot::where('course_id', $courseId)
            ->where('current_score', '<', $minScore)
            ->count();

        $totalStudents = AiPerformanceSnapshot::where('course_id', $courseId)->count();
        $excellentRate = $totalStudents > 0 ? round(($excellentCount / $totalStudents) * 100) : 0;

        return view('principal.dashboard', compact('school', 'excellentRate', 'alertCount', 'targetScore'));
    }
}
