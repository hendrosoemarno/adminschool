<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RoleDashboardController extends Controller
{
    public function principal()
    {
        $user = session('moodle_user');
        if (!$user) return redirect()->route('moodle.login');

        $school = DB::table('ai_schools')->where('principal_name', $user['id'])->first();
        return view('principal.dashboard', compact('user', 'school'));
    }

    public function homeroom()
    {
        $user = session('moodle_user');
        if (!$user) return redirect()->route('moodle.login');

        $class = DB::table('ai_classes')
            ->where('homeroom_teacher_id', $user['id'])
            ->orWhere('homeroom_moodle_user_id', $user['id'])
            ->first();
        return view('homeroom.dashboard', compact('user', 'class'));
    }

    public function teacher()
    {
        $user = session('moodle_user');
        if (!$user) return redirect()->route('moodle.login');

        $assignments = DB::table('ai_school_teachers')
            ->where('moodle_user_id', $user['id'])
            ->get();
        return view('teacher.dashboard', compact('user', 'assignments'));
    }
}
