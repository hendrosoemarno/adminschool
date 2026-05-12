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
        $userId = session('moodle_user.id');
        $courseId = $request->input('course_id', 1);

        // Cari kelas yang diampu oleh wali kelas ini
        $class = AiClass::where('homeroom_teacher_id', $userId)->first();

        $class = AiClass::where('homeroom_teacher_id', $userId)->first();

        $students = collect([]);
        $healthScore = 0;
        $courseId = $request->input('course_id', 1);

        if ($class) {
            $healthScore = $this->healthService->calculateClassHealth($class->id, $courseId);
            $students = AiPerformanceSnapshot::where('course_id', $courseId)
                ->with('user')
                ->get();
        }

        return view('homeroom.dashboard', compact('healthScore', 'students', 'class', 'courseId'));
    }
}
