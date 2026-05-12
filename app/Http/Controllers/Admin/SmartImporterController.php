<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmartImporterController extends Controller
{
    public function index()
    {
        // Ambil daftar Rombongan Belajar yang sudah ditautkan ke Course Moodle
        $classes = \App\Models\AiClass::with('school')
            ->whereNotNull('moodle_course_id')
            ->get();

        // Tetap ambil daftar course manual sebagai cadangan
        $courses = DB::connection('moodle')->table('course')
            ->select('id', 'fullname', 'shortname')
            ->where('id', '>', 1)
            ->get();

        return view('admin.smart_importer', compact('courses', 'classes'));
    }

    public function preview(Request $request)
    {
        $request->validate([
            'file_csv' => 'required|file',
        ]);

        $file = $request->file('file_csv');
        $path = $file->getRealPath();
        
        // Deteksi pemisah otomatis
        $fileContent = file_get_contents($path);
        
        // Bersihkan BOM (Byte Order Mark) jika ada
        $fileContent = preg_replace('/^\xEF\xBB\xBF/', '', $fileContent);
        
        $firstLine = strtok($fileContent, "\r\n");
        $commaCount = substr_count($firstLine, ',');
        $semicolonCount = substr_count($firstLine, ';');
        $delimiter = ($semicolonCount > $commaCount) ? ";" : ",";

        $data = [];
        if (($handle = fopen($path, "r")) !== FALSE) {
            $rawHeader = fgetcsv($handle, 1000, $delimiter); 
            $header = array_map(function($h) {
                $h = preg_replace('/^\xEF\xBB\xBF/', '', $h);
                return strtolower(trim($h));
            }, $rawHeader);
            
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if (count($row) == count($header)) {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        $classes = \App\Models\AiClass::with('school')->whereNotNull('moodle_course_id')->get();
        $courses = DB::connection('moodle')->table('course')->select('id', 'fullname')->get();
        $previewData = $data;
        
        return view('admin.smart_importer', compact('courses', 'classes', 'previewData', 'delimiter'));
    }

    public function process(Request $request)
    {
        $targetId = $request->target_id; // Bisa berupa 'class_X' atau 'course_X'
        $students = json_decode($request->students_data, true);
        
        // Resolusi Course ID
        $courseId = null;
        if (strpos($targetId, 'class_') === 0) {
            $classId = str_replace('class_', '', $targetId);
            $class = \App\Models\AiClass::find($classId);
            $courseId = $class->moodle_course_id;
        } else {
            $courseId = str_replace('course_', '', $targetId);
        }

        if (!$courseId) {
            return redirect()->back()->with('error', 'Target pendaftaran (Course Moodle) tidak ditemukan.');
        }
        
        $successCount = 0;
        $nextUserId = DB::connection('moodle')->table('user')->max('id') + 1;
        
        foreach ($students as $student) {
            // 1. Cek apakah user sudah ada berdasarkan email atau NIS (username)
            $username = $student['nis'] ?? ($student['nisn'] ?? '-'); 
            $email = $student['email'] ?? '-';

            $existingUser = DB::connection('moodle')->table('user')
                ->where('username', $username)
                ->first();

            // Jika tidak ketemu username, cek email
            if (!$existingUser && $email !== '-') {
                $existingUser = DB::connection('moodle')->table('user')
                    ->where('email', $email)
                    ->first();
            }

            if (!$existingUser) {
                $rawPassword = !empty($student['password']) ? $student['password'] : 'siswa123';

                DB::connection('moodle')->table('user')->insert([
                    'id' => $nextUserId,
                    'username' => $username,
                    'password' => password_hash($rawPassword, PASSWORD_BCRYPT),
                    'firstname' => $student['nama_depan'] ?? ($student['nama'] ?? '-'),
                    'lastname' => $student['nama_belakang'] ?? ($student['last_name'] ?? ''),
                    'email' => $email,
                    'confirmed' => 1,
                    'mnethostid' => 1,
                    'timemodified' => time(),
                ]);
                
                $userId = $nextUserId;
                $nextUserId++;
            } else {
                $userId = $existingUser->id;
            }

            // 2. Enroll ke Course
            $enrol = DB::connection('moodle')->table('enrol')
                ->where('courseid', $courseId)
                ->where('enrol', 'manual')
                ->first();

            if ($enrol) {
                $alreadyEnrolled = DB::connection('moodle')->table('user_enrolments')
                    ->where('enrolid', $enrol->id)
                    ->where('userid', $userId)
                    ->exists();

                if (!$alreadyEnrolled) {
                    DB::connection('moodle')->table('user_enrolments')->insert([
                        'enrolid' => $enrol->id,
                        'userid' => $userId,
                        'timestart' => time(),
                        'timeend' => 0,
                        'modifierid' => 2, 
                        'timecreated' => time(),
                        'timemodified' => time(),
                    ]);
                }
            }

            $successCount++;
        }

        return redirect()->route('admin.smart_importer')->with('success', "$successCount Siswa berhasil disinkronkan ke Moodle.");
    }
}
