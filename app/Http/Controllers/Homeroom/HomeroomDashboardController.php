<?php

namespace App\Http\Controllers\Homeroom;

use App\Http\Controllers\Controller;
use App\Services\ClassHealthService;
use App\Models\AiClass;
use App\Models\AiPerformanceSnapshot;
use Illuminate\Http\Request;

class HomeroomDashboardController extends Controller
{
    protected $healthService;

    public function __construct(ClassHealthService $healthService)
    {
        $this->healthService = $healthService;
    }

    public function index(Request $request)
    {
        // Asumsi: Kita ambil ID Kelas yang diampu Wali Kelas ini
        // (Misal dari data session user Moodle yang login)
        $classId = 1; 
        $courseId = $request->input('course_id', 1);

        // 1. Hitung Skor Kesehatan Kelas
        $healthScore = $this->healthService->calculateClassHealth($classId, $courseId);

        // 2. Ambil data daftar nilai siswa untuk tabel
        // (Join snapshot dengan data user Moodle)
        $students = AiPerformanceSnapshot::where('course_id', $courseId)
            ->with('user')
            ->get();

        return view('homeroom.dashboard', compact('healthScore', 'students'));
    }
}
