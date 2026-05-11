<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AiPerformanceSnapshot;
use App\Models\AiCompetencyReguler;
use App\Services\PerformanceCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherDashboardController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->input('course_id', 1); // Mata pelajaran yang diampu guru
        
        // 1. Ambil Topik Tersulit (Rata-rata terendah)
        // Kita join ai_performance_snapshots dengan kompetensi
        // Untuk demo, kita ambil data agregat kuis
        $lowPerformingTopics = DB::connection('moodle')
            ->table('question_categories as qc')
            ->join('question as q', 'qc.id', '=', 'q.category')
            ->join('question_attempts as qa', 'q.id', '=', 'qa.questionid')
            ->join('question_attempt_steps as qas', 'qa.id', '=', 'qas.questionattemptid')
            ->select('qc.name', DB::raw('AVG(qas.fraction) * 100 as avg_score'))
            ->groupBy('qc.id', 'qc.name')
            ->orderBy('avg_score', 'asc')
            ->limit(3)
            ->get();

        // 2. Data Siswa untuk Tabel
        $students = AiPerformanceSnapshot::where('course_id', $courseId)
            ->with('user')
            ->get();

        return view('teacher.dashboard', compact('lowPerformingTopics', 'students'));
    }
}
