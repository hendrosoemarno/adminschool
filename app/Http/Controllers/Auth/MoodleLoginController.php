<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MoodleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Helpers\MoodlePasswordHelper;

class MoodleLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.moodle_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = MoodleUser::where('username', $request->username)->first();

        if ($user && MoodlePasswordHelper::verifyMoodlePassword($request->password, $user->password)) {
            $role = 'student'; // Default
            
            // 1. Cek Super Admin (Deteksi otomatis dari konfigurasi Moodle 'siteadmins')
            $moodleAdminsConfig = \Illuminate\Support\Facades\DB::connection('moodle')->table('config')->where('name', 'siteadmins')->value('value');
            $moodleAdminIds = explode(',', $moodleAdminsConfig);
            
            if (in_array($user->id, $moodleAdminIds)) {
                $role = 'admin';
            } 
            // 2. Cek Kepala Sekolah
            elseif (\Illuminate\Support\Facades\DB::table('ai_schools')->where('principal_name', $user->id)->exists()) {
                $role = 'principal';
            }
            // 3. Cek Wali Kelas
            elseif (\Illuminate\Support\Facades\DB::table('ai_classes')->where('homeroom_teacher_id', $user->id)->exists()) {
                $role = 'homeroom';
            }
            // 4. Cek Guru Mapel
            elseif (\Illuminate\Support\Facades\DB::table('ai_school_teachers')->where('moodle_user_id', $user->id)->exists()) {
                $role = 'teacher';
            }

            Session::put('moodle_user', [
                'id' => $user->id,
                'username' => $user->username,
                'fullname' => $user->firstname . ' ' . $user->lastname,
                'email' => $user->email,
                'role' => $role,
            ]);

            // Redireksi berdasarkan Role
            return match($role) {
                'admin'     => redirect()->route('admin.dashboard'),
                'principal' => redirect()->route('principal.dashboard'),
                'homeroom'  => redirect()->route('homeroom.dashboard'),
                'teacher'   => redirect()->route('teacher.dashboard'),
                default     => redirect()->route('student.dashboard'), // Siswa
            };
        }

        return back()->withErrors(['login' => 'Username atau password salah.']);
    }

    public function logout()
    {
        Session::forget('moodle_user');
        return redirect()->route('moodle.login');
    }
}
