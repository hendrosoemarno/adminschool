<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AiCompetencyReguler;
use App\Models\AiSchool;

class QuizAllocatorController extends Controller
{
    public function index()
    {
        // 1. Ambil semua kompetensi reguler
        $competencies = AiCompetencyReguler::all();
        $schools = AiSchool::all();

        // 2. Ambil semua kuis dari moodle (mdlax_quiz)
        $moodleQuizzes = DB::connection('moodle')->table('quiz')
            ->select('id', 'name', 'course')
            ->get();

        // 3. Ambil data alokasi yang sudah ada
        $allocations = DB::table('ai_quiz_allocations')
            ->join('ai_competencies_reguler', 'ai_competencies_reguler.id', '=', 'ai_quiz_allocations.competency_id')
            ->leftJoin('ai_schools', 'ai_schools.id', '=', 'ai_quiz_allocations.school_id')
            ->select(
                'ai_quiz_allocations.*', 
                'ai_competencies_reguler.topic_name as subject',
                'ai_schools.school_name'
            )
            ->get()
            ->map(function($alloc) use ($moodleQuizzes) {
                $quiz = $moodleQuizzes->where('id', $alloc->moodle_quiz_id)->first();
                $alloc->quiz_name = $quiz->name ?? 'Kuis Tidak Ditemukan';
                return $alloc;
            });

        return view('admin.active_quizzes', compact('competencies', 'moodleQuizzes', 'allocations', 'schools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'moodle_quiz_id' => 'required',
            'competency_id' => 'required',
            'category' => 'required',
        ]);

        DB::table('ai_quiz_allocations')->insert([
            'moodle_quiz_id' => $request->moodle_quiz_id,
            'competency_id' => $request->competency_id,
            'category' => $request->category,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'attempts' => $request->attempts ?? 1,
            'school_id' => $request->school_id,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Kuis berhasil dialokasikan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'moodle_quiz_id' => 'required',
            'competency_id' => 'required',
            'category' => 'required',
        ]);

        DB::table('ai_quiz_allocations')->where('id', $id)->update([
            'moodle_quiz_id' => $request->moodle_quiz_id,
            'competency_id' => $request->competency_id,
            'category' => $request->category,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'attempts' => $request->attempts ?? 1,
            'school_id' => $request->school_id,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Alokasi kuis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('ai_quiz_allocations')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Alokasi kuis berhasil dihapus.');
    }
}
