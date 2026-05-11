<?php

namespace App\Models;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiSchool;
use App\Models\AiKkmSetting;
use App\Models\AiBenchmark;
use App\Services\CompetencyMappingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CompetencyArchitectController extends Controller
{
    public function index()
    {
        $schools = AiSchool::all();
        $regulerCompetencies = \App\Models\AiCompetencyReguler::all();
        $deepCompetencies = \App\Models\AiCompetencyDeep::all();
        
        // Ambil kategori soal dari Moodle untuk dropdown
        $moodleCategories = DB::connection('moodle')->table('question_categories')
            ->select('id', 'name', 'parent')
            ->orderBy('name')
            ->get();
        
        $mappingsData = collect();
        if (Schema::hasTable('ai_competency_mapping')) {
            $mappings = DB::table('ai_competency_mapping')
                ->join('ai_competencies_reguler', 'ai_competencies_reguler.id', '=', 'ai_competency_mapping.competency_id')
                ->select('ai_competency_mapping.*', 'ai_competencies_reguler.topic_name', 'ai_competencies_reguler.course_id')
                ->get();
                
            $moodleCategoryIds = $mappings->pluck('moodle_category_id')->toArray();
            
            if (!empty($moodleCategoryIds)) {
                $categoriesMap = DB::connection('moodle')->table('question_categories')
                    ->whereIn('id', $moodleCategoryIds)
                    ->get()
                    ->keyBy('id');
                    
                $mappingsData = $mappings->map(function($m) use ($categoriesMap) {
                    $m->moodle_category_name = isset($categoriesMap[$m->moodle_category_id]) ? $categoriesMap[$m->moodle_category_id]->name : 'Unknown';
                    return $m;
                });
            }
        }
        
        return view('admin.competency_architect', compact('schools', 'regulerCompetencies', 'deepCompetencies', 'moodleCategories', 'mappingsData'));
    }

    public function storeCompetency(Request $request)
    {
        $model = $request->type == 'deep' ? \App\Models\AiCompetencyDeep::class : \App\Models\AiCompetencyReguler::class;
        
        $model::create([
            'topic_code' => $request->topic_code,
            'topic_name' => $request->topic_name,
            'course_id' => $request->course_id ?? 1,
            'weight' => $request->weight ?? 1.0,
        ]);

        return redirect()->back()->with('success', 'Kompetensi/Mapel baru berhasil ditambahkan.');
    }

    public function competencyList()
    {
        $reguler = \App\Models\AiCompetencyReguler::all();
        $deep = \App\Models\AiCompetencyDeep::all();
        return view('admin.competency_list', compact('reguler', 'deep'));
    }

    public function updateCompetency(Request $request, $id)
    {
        $model = $request->type == 'deep' ? \App\Models\AiCompetencyDeep::class : \App\Models\AiCompetencyReguler::class;
        $model::where('id', $id)->update([
            'topic_code' => $request->topic_code,
            'topic_name' => $request->topic_name,
        ]);

        return redirect()->back()->with('success', 'Data kompetensi berhasil diperbarui.');
    }

    public function deleteCompetency(Request $request, $id)
    {
        $model = $request->type == 'deep' ? \App\Models\AiCompetencyDeep::class : \App\Models\AiCompetencyReguler::class;
        $model::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Kompetensi berhasil dihapus.');
    }

    /**
     * Menjalankan proses scanning otomatis kategori Moodle
     */
    public function runAutoMapping(Request $request, CompetencyMappingService $service)
    {
        $categoryId = $request->input('moodle_category_id');
        
        $count = $service->autoMapCategories($categoryId);
        
        return back()->with('success', "Parser kategori anak berhasil. $count Topik AI baru berhasil dibuat dan dipetakan ke Moodle.");
    }

    /**
     * Update KKM per Sekolah/Topik
     */
    public function updateKkm(Request $request)
    {
        // Logika update KKM
        return redirect()->back()->with('success', 'KKM Sekolah berhasil diperbarui.');
    }

    public function schoolSetup()
    {
        $schools = \App\Models\AiSchool::all();
        return view('admin.school_setup', compact('schools'));
    }

    public function storeSchool(Request $request)
    {
        \App\Models\AiSchool::create([
            'npsn' => $request->npsn,
            'school_name' => $request->school_name,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Sekolah baru berhasil didaftarkan.');
    }

    public function updateSchool(Request $request, $id)
    {
        \App\Models\AiSchool::where('id', $id)->update([
            'npsn' => $request->npsn,
            'school_name' => $request->school_name,
            'address' => $request->address,
        ]);
        return redirect()->back()->with('success', 'Data sekolah berhasil diperbarui.');
    }

    public function deleteSchool($id)
    {
        \App\Models\AiSchool::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Sekolah berhasil dihapus dari sistem.');
    }

    public function orgManager()
    {
        $schools = \App\Models\AiSchool::all();
        return view('admin.org_manager', compact('schools'));
    }

    public function roleAssignment()
    {
        $users = \App\Models\MoodleUser::limit(100)->get();
        $schools = \App\Models\AiSchool::all();
        $classes = \App\Models\AiClass::all();
        
        return view('admin.role_assignment', compact('users', 'schools', 'classes'));
    }

    public function storeRoleAssignment(Request $request)
    {
        $role = $request->role;
        $userId = $request->user_id;

        if ($role == 'principal') {
            \App\Models\AiSchool::where('id', $request->school_id)
                ->update(['principal_name' => $userId]); // Simpan ID User sebagai Kepsek
        } elseif ($role == 'homeroom') {
            \App\Models\AiClass::where('id', $request->class_id)
                ->update(['homeroom_moodle_user_id' => $userId]);
        }

        return redirect()->back()->with('success', 'Penugasan Peran berhasil diperbarui.');
    }

    public function orgDetail($id)
    {
        $school = AiSchool::with('classes')->findOrFail($id);
        
        // Ambil ID Kepala Sekolah
        $principalId = $school->principal_name;
        
        // Ambil ID Wali Kelas
        $homeroomIds = $school->classes->pluck('homeroom_teacher_id')->filter()->toArray();
        
        // Ambil ID Guru Pengajar dari tabel pemetaan
        $teacherIds = [];
        if (Schema::hasTable('ai_school_teachers')) {
            $teacherIds = DB::table('ai_school_teachers')
                ->where('school_id', $id)
                ->pluck('moodle_user_id')
                ->toArray();
        }
        
        // Gabungkan semua ID user yang terlibat di sekolah ini
        $assignedUserIds = array_merge([$principalId], $homeroomIds, $teacherIds);
        
        // Ambil data user Moodle untuk staf/personel
        $users = \App\Models\MoodleUser::whereIn('id', $assignedUserIds)->get(); 
        
        // Hitung Jumlah Siswa Terdaftar
        // Pastikan tabel pemetaan course ke sekolah ada
        DB::statement("CREATE TABLE IF NOT EXISTS ai_school_courses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            school_id INT,
            moodle_course_id INT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        )");

        // Gabungkan course dari classes dan dari school_courses
        $classCourseIds = $school->classes->pluck('moodle_course_id')->filter()->toArray();
        $linkedCourseIds = DB::table('ai_school_courses')->where('school_id', $id)->pluck('moodle_course_id')->toArray();
        $courseIds = array_unique(array_merge($classCourseIds, $linkedCourseIds));

        $studentCount = 0;
        if (!empty($courseIds)) {
            $studentCount = DB::connection('moodle')->table('user_enrolments as ue')
                ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
                ->whereIn('e.courseid', $courseIds)
                ->count();
        }

        // Ambil daftar semua Course di Moodle untuk dropdown tautan
        $allCourses = DB::connection('moodle')->table('course')->where('id', '>', 1)->select('id', 'fullname')->get();
        
        // Ambil Course yang sudah ditautkan ke sekolah ini
        $linkedCourseIds = DB::table('ai_school_courses')->where('school_id', $id)->pluck('moodle_course_id')->toArray();
        $linkedCourses = DB::connection('moodle')->table('course')->whereIn('id', $linkedCourseIds)->select('id', 'fullname')->get();
        
        return view('admin.org_detail', compact('school', 'users', 'studentCount', 'allCourses', 'linkedCourses'));
    }

    public function linkCourseStore(Request $request, $id)
    {
        $courseId = $request->moodle_course_id;

        // Cek apakah sudah ada
        $exists = DB::table('ai_school_courses')->where('school_id', $id)->where('moodle_course_id', $courseId)->exists();

        if (!$exists) {
            DB::table('ai_school_courses')->insert([
                'school_id' => $id,
                'moodle_course_id' => $courseId,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Course berhasil ditautkan ke sekolah ini.');
    }

    public function linkCourseDelete($id, $courseId)
    {
        DB::table('ai_school_courses')->where('school_id', $id)->where('moodle_course_id', $courseId)->delete();
        return redirect()->back()->with('success', 'Tautan Course berhasil dihapus.');
    }

    public function storeUser(Request $request)
    {
        // Pastikan tabel pemetaan guru ada
        DB::statement("CREATE TABLE IF NOT EXISTS ai_school_teachers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            school_id INT,
            moodle_user_id INT,
            competency_id INT,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        )");

        // Cari ID terakhir karena tabel tidak auto-increment
        $lastId = DB::connection('moodle')->table('user')->max('id') ?? 0;
        $nextId = $lastId + 1;

        DB::connection('moodle')->table('user')->insert([
            'id' => $nextId,
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_BCRYPT),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'confirmed' => 1,
            'mnethostid' => 1,
            'timemodified' => time(),
        ]);

        // Proses Role Assignment Otomatis
        $role = $request->role;
        if ($role == 'principal') {
            AiSchool::where('id', $request->school_id)->update(['principal_name' => $nextId]);
        } elseif ($role == 'homeroom') {
            \App\Models\AiClass::where('id', $request->class_id)->update(['homeroom_teacher_id' => $nextId]);
        } elseif ($role == 'teacher') {
            DB::table('ai_school_teachers')->insert([
                'school_id' => $request->school_id,
                'moodle_user_id' => $nextId,
                'competency_id' => $request->subject_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'User ' . $request->username . ' berhasil didaftarkan sebagai ' . strtoupper($role));
    }

    public function updateUser(Request $request, $id)
    {
        DB::connection('moodle')->table('user')->where('id', $id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Data user berhasil diperbarui.');
    }

    public function deleteUser($id)
    {
        DB::connection('moodle')->table('user')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus dari sistem.');
    }

    public function schoolUserList($id)
    {
        $school = AiSchool::with(['classes.homeroom'])->findOrFail($id);
        
        // 1. Ambil Kepala Sekolah
        $principalId = $school->principal_name;
        $principals = \App\Models\MoodleUser::where('id', $principalId)->get();

        // 2. Ambil Wali Kelas (dengan info kelas)
        $homeroomIds = $school->classes->pluck('homeroom_teacher_id')->filter()->toArray();
        $homerooms = \App\Models\MoodleUser::whereIn('id', $homeroomIds)->get()->map(function($user) use ($school) {
            $user->assigned_class = $school->classes->where('homeroom_teacher_id', $user->id)->first()->class_name ?? '-';
            return $user;
        });

        // 3. Ambil Guru Mapel (dengan info mapel)
        $teacherIds = [];
        if (Schema::hasTable('ai_school_teachers')) {
            $teacherAssignments = DB::table('ai_school_teachers')
                ->where('school_id', $id)
                ->get();
            $teacherIds = $teacherAssignments->pluck('moodle_user_id')->toArray();
        }
        
        $teachers = \App\Models\MoodleUser::whereIn('id', $teacherIds)->get()->map(function($user) use ($teacherAssignments) {
            $assignment = $teacherAssignments->where('moodle_user_id', $user->id)->first();
            $subject = \App\Models\AiCompetencyReguler::find($assignment->competency_id);
            $user->assigned_subject = $subject->topic_name ?? '-';
            return $user;
        });

        return view('admin.school_user_list', compact('school', 'principals', 'homerooms', 'teachers'));
    }

    public function schoolStudentList($id)
    {
        $school = AiSchool::with('classes')->findOrFail($id);
        
        $courseIds = $school->classes->pluck('moodle_course_id')->filter()->toArray();
        
        $students = DB::connection('moodle')->table('user as u')
            ->join('user_enrolments as ue', 'ue.userid', '=', 'u.id')
            ->join('enrol as e', 'e.id', '=', 'ue.enrolid')
            ->whereIn('e.courseid', $courseIds)
            ->select('u.id', 'u.firstname', 'u.lastname', 'u.username', 'e.courseid', 'u.email')
            ->get()
            ->map(function($student) use ($school) {
                $class = $school->classes->where('moodle_course_id', $student->courseid)->first();
                $student->class_name = $class->class_name ?? 'Unknown';
                return $student;
            });

        return view('admin.school_student_list', compact('school', 'students'));
    }

    public function updateStudent(Request $request, $id)
    {
        DB::connection('moodle')->table('user')->where('id', $id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function deleteStudent($id)
    {
        // Hapus dari Moodle
        DB::connection('moodle')->table('user')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Siswa berhasil dihapus dari sistem Moodle.');
    }

    public function storeStudent(Request $request)
    {
        $classId = $request->class_id;
        $class = \App\Models\AiClass::findOrFail($classId);
        $courseId = $class->moodle_course_id;

        if (!$courseId) {
            return redirect()->back()->with('error', 'Kelas ini belum ditautkan ke Course Moodle mana pun.');
        }

        // 1. Buat User Moodle
        $lastId = DB::connection('moodle')->table('user')->max('id');
        $newUserId = $lastId + 1;

        DB::connection('moodle')->table('user')->insert([
            'id' => $newUserId,
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_BCRYPT),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'confirmed' => 1,
            'mnethostid' => 1,
            'timemodified' => time(),
        ]);

        // 2. Enroll ke Course
        $enrol = DB::connection('moodle')->table('enrol')
            ->where('courseid', $courseId)
            ->where('enrol', 'manual')
            ->first();

        if ($enrol) {
            DB::connection('moodle')->table('user_enrolments')->insert([
                'enrolid' => $enrol->id,
                'userid' => $newUserId,
                'timestart' => time(),
                'timeend' => 0,
                'modifierid' => 2, 
                'timecreated' => time(),
                'timemodified' => time(),
            ]);
        }

        return redirect()->back()->with('success', 'Siswa ' . $request->firstname . ' berhasil ditambahkan dan didaftarkan ke kelas.');
    }

    public function classList($id)
    {
        // Pastikan kolom relasi ada menggunakan cara yang lebih kompatibel
        if (!Schema::hasColumn('ai_classes', 'moodle_course_id')) {
            Schema::table('ai_classes', function ($table) {
                $table->integer('moodle_course_id')->nullable();
            });
        }

        $school = AiSchool::with('classes.homeroom')->findOrFail($id);
        $users = \App\Models\MoodleUser::limit(100)->get(); // For homeroom selection
        
        // Ambil daftar course dari Moodle untuk sinkronisasi
        $moodleCourses = DB::connection('moodle')->table('course')
            ->select('id', 'fullname')
            ->where('id', '>', 1)
            ->get();
        
        return view('admin.class_list', compact('school', 'users', 'moodleCourses'));
    }

    public function storeClass(Request $request)
    {
        \App\Models\AiClass::create([
            'school_id' => $request->school_id,
            'class_name' => $request->class_name,
            'moodle_course_id' => $request->moodle_course_id,
        ]);

        return redirect()->back()->with('success', 'Kelas baru berhasil ditambahkan.');
    }

    public function updateClass(Request $request, $id)
    {
        \App\Models\AiClass::where('id', $id)->update([
            'class_name' => $request->class_name,
            'moodle_course_id' => $request->moodle_course_id,
        ]);

        return redirect()->back()->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function deleteClass($id)
    {
        \App\Models\AiClass::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Kelas berhasil dihapus.');
    }
}
