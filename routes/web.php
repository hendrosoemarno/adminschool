<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MoodleLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentScoreController;
use App\Http\Controllers\StudentTryoutQuickController;
use App\Http\Controllers\StudentTryoutBasicController;
use App\Http\Controllers\StudentTryoutFullController;
use App\Http\Controllers\StudentTryoutWhatsappController;

Route::get('/demo', function () {
    return view('demo.login');
});
Route::post('/demo/login', function () {
    return redirect('/demo/principal');
});
Route::get('/demo/principal', function () {
    return view('principal.demo');
});
Route::get('/demo/principal/student-mastery', function () { return view('principal.demo_student_mastery'); });
Route::get('/demo/principal/excellent', function () { return view('principal.demo_excellent'); });
Route::get('/demo/principal/alert', function () { return view('principal.demo_alert'); });
Route::get('/demo/principal/alert-groups', function () { return view('principal.demo_alert_groups'); });

Route::get('/demo/smp/principal', function () {
    return view('principal.demo_smp');
});
Route::get('/demo/smp/principal/student-mastery', function () { return view('principal.demo_smp_student_mastery'); });
Route::get('/demo/smp/principal/excellent', function () { return view('principal.demo_smp_excellent'); });
Route::get('/demo/smp/principal/alert', function () { return view('principal.demo_smp_alert'); });
Route::get('/demo/smp/principal/alert-groups', function () { return view('principal.demo_smp_alert_groups'); });

Route::get('/demo/sma/principal', function () {
    return view('principal.demo_sma');
});
Route::get('/demo/sma/principal/student-mastery', function () { return view('principal.demo_sma_student_mastery'); });
Route::get('/demo/sma/principal/excellent', function () { return view('principal.demo_sma_excellent'); });
Route::get('/demo/sma/principal/alert', function () { return view('principal.demo_sma_alert'); });
Route::get('/demo/sma/principal/alert-groups', function () { return view('principal.demo_sma_alert_groups'); });

// Smart School Demo Routes
Route::prefix('demo/smart-school')->group(function () {
    Route::get('/', function () { return view('demo.smart_school.landing'); });
    // Guru
    Route::get('/guru', function () { return view('demo.smart_school.guru.dashboard'); });
    Route::get('/guru/modul', function () { return view('demo.smart_school.guru.modul_list'); });
    Route::get('/guru/modul/editor', function () { return view('demo.smart_school.guru.modul_editor'); });
    Route::get('/guru/modul/download', function () { return view('demo.smart_school.guru.modul_download'); });
    Route::get('/guru/asesmen', function () { return view('demo.smart_school.guru.asesmen'); });
    Route::get('/guru/narasi', function () { return view('demo.smart_school.guru.narasi'); });
    Route::get('/guru/jurnal', function () { return view('demo.smart_school.guru.jurnal'); });
    Route::get('/guru/presensi', function () { return view('demo.smart_school.guru.presensi'); });
    Route::get('/guru/remedial', function () { return view('demo.smart_school.guru.remedial'); });
    Route::get('/guru/rapor', function () { return view('demo.smart_school.guru.rapor'); });
    // Kepsek
    Route::get('/kepsek', function () { return view('demo.smart_school.kepsek.dashboard'); });
    Route::get('/kepsek/smart-mapping', function () { return view('demo.smart_school.kepsek.smart_mapping'); });
    Route::get('/kepsek/supervisi-jurnal', function () { return view('demo.smart_school.kepsek.supervisi_jurnal'); });
    Route::get('/kepsek/export', function () { return view('demo.smart_school.kepsek.export'); });
    // Admin
    Route::get('/admin', function () { return view('demo.smart_school.admin.users'); });
    Route::get('/admin/konfigurasi', function () { return view('demo.smart_school.admin.konfigurasi'); });
    Route::get('/admin/log', function () { return view('demo.smart_school.admin.log'); });
});

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [MoodleLoginController::class, 'showLoginForm'])->name('moodle.login');
Route::post('/login', [MoodleLoginController::class, 'login'])->name('moodle.login.submit');
Route::get('/logout', [MoodleLoginController::class, 'logout'])->name('moodle.logout');

Route::get('/dashboard', function () {
    if (!session()->has('moodle_user')) {
        return redirect()->route('moodle.login');
    }
    $user = session('moodle_user');
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/principal/dashboard', [App\Http\Controllers\RoleDashboardController::class, 'principal'])->name('principal.dashboard');
Route::get('/homeroom/dashboard', [App\Http\Controllers\RoleDashboardController::class, 'homeroom'])->name('homeroom.dashboard');
Route::get('/teacher/dashboard', [App\Http\Controllers\RoleDashboardController::class, 'teacher'])->name('teacher.dashboard');

Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('students.index');
    Route::get('/scores', [StudentScoreController::class, 'index'])->name('students.scores');
    Route::get('/tryoutquick', [StudentTryoutQuickController::class, 'index'])->name('students.tryoutquick');
    Route::get('/tryoutquick/{id}', [StudentTryoutQuickController::class, 'show'])->name('students.tryoutquick.report');
    Route::get('/tryoutbasic', [StudentTryoutBasicController::class, 'index'])->name('students.tryoutbasic');
    Route::get('/tryoutbasic/{id}', [StudentTryoutBasicController::class, 'show'])->name('students.tryoutbasic.report');
    Route::get('/tryoutfull', [StudentTryoutFullController::class, 'index'])->name('students.tryoutfull');
    Route::get('/tryoutfull/{userid}/{courseid}', [StudentTryoutFullController::class, 'show'])->name('students.tryoutfull.show');
    Route::get('/tryoutwhatsapp', [StudentTryoutWhatsappController::class, 'index'])->name('students.tryoutwhatsapp');
    Route::get('/tryoutwhatsapp/select/{userid}/{courseid}', [StudentTryoutWhatsappController::class, 'select'])->name('students.tryoutwhatsapp.select');
    Route::get('/tryoutwhatsapp/report/{id?}', [StudentTryoutWhatsappController::class, 'show'])->name('students.tryoutwhatsapp.report');

    // WA Report History
    Route::get('/tryoutwhatsapp/history', [StudentTryoutWhatsappController::class, 'history'])->name('students.tryoutwhatsapp.history');
    Route::post('/tryoutwhatsapp/store-report', [StudentTryoutWhatsappController::class, 'storeReport'])->name('students.tryoutwhatsapp.store_report');
    Route::post('/tryoutwhatsapp/update-report/{id}', [StudentTryoutWhatsappController::class, 'updateReport'])->name('students.tryoutwhatsapp.update_report');
    Route::delete('/tryoutwhatsapp/delete-report/{id}', [StudentTryoutWhatsappController::class, 'destroyReport'])->name('students.tryoutwhatsapp.delete_report');
    Route::get('/tryout-data', [App\Http\Controllers\StudentTryoutDataController::class, 'index'])->name('students.tryout_data');

    // Data Try Out Lengkap (Checklist)
    Route::get('/tryout-complete', [App\Http\Controllers\StudentTryoutCompleteController::class, 'index'])->name('students.tryout_complete');
    Route::post('/tryout-complete/toggle', [App\Http\Controllers\StudentTryoutCompleteController::class, 'toggleStatus'])->name('students.tryout_complete.toggle');

    Route::get('/{id}', [StudentController::class, 'show'])->name('students.show');
});

// Temporary route to create table if migration fails via CLI
Route::get('/setup-db-report-status', function () {
    try {
        if (!Illuminate\Support\Facades\Schema::hasTable('report_statuses')) {
            Illuminate\Support\Facades\Schema::create('report_statuses', function (Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('quiz_attempt_id')->unique();
                $table->boolean('is_report_created')->default(false);
                $table->timestamps();
            });
            return "Table 'report_statuses' created successfully.";
        }
        return "Table 'report_statuses' already exists.";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});
Route::get('/check-siap-cols', function () {
    try {
        $cols = DB::connection('moodle')->select("SHOW COLUMNS FROM mdlax_siap");
        return response()->json($cols);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

// Dashboard Routes (Dummy Data Oriented)
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/competency-mapping', function () {
        return view('admin.competency_mapping');
    });

    Route::get('/registered-students', function () {
        return view('admin.registered_students');
    });

    Route::get('/active-quizzes', [App\Http\Controllers\Admin\QuizAllocatorController::class, 'index'])->name('admin.active_quizzes');
    Route::post('/active-quizzes/store', [App\Http\Controllers\Admin\QuizAllocatorController::class, 'store'])->name('admin.quiz_allocate');
    Route::put('/active-quizzes/{id}', [App\Http\Controllers\Admin\QuizAllocatorController::class, 'update'])->name('admin.quiz_allocate_update');
    Route::delete('/active-quizzes/{id}', [App\Http\Controllers\Admin\QuizAllocatorController::class, 'destroy'])->name('admin.quiz_deallocate');

    Route::get('/competency-architect', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'index'])->name('admin.competency_architect');
    Route::get('/competency-list', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'competencyList'])->name('admin.competency_list');
    Route::post('/competency-architect/auto-map', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'runAutoMapping'])->name('admin.competency_auto_map');
    Route::post('/competency-architect/update-kkm', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'updateKkm'])->name('admin.update_kkm');
    Route::post('/competency-architect/update-benchmark', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'updateBenchmark'])->name('admin.update_benchmark');
    Route::post('/competency-architect/store', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'storeCompetency'])->name('admin.competency_store');
    Route::post('/competency-architect/update/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'updateCompetency'])->name('admin.competency_update');
    Route::post('/competency-architect/delete/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'deleteCompetency'])->name('admin.competency_delete');

    // School Management
    Route::get('/school-setup', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'schoolSetup'])->name('admin.school_setup');
    Route::post('/school-setup', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'storeSchool'])->name('admin.school_store');
    Route::post('/school-update/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'updateSchool'])->name('admin.school_update');
    Route::post('/school-delete/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'deleteSchool'])->name('admin.school_delete');

    // Role & User Management
    Route::get('/role-assignment', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'roleAssignment'])->name('admin.role_assignment');
    Route::post('/role-assignment', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'storeRoleAssignment'])->name('admin.role_store');

    Route::get('/smart-importer', [App\Http\Controllers\Admin\SmartImporterController::class, 'index'])->name('admin.smart_importer');
    Route::post('/smart-importer/preview', [App\Http\Controllers\Admin\SmartImporterController::class, 'preview'])->name('admin.smart_importer.preview');
    Route::post('/smart-importer/process', [App\Http\Controllers\Admin\SmartImporterController::class, 'process'])->name('admin.smart_importer.process');

    Route::get('/org-manager', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'orgManager'])->name('admin.org_manager');
    Route::get('/org-detail/{id}/students', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'schoolStudentList'])->name('admin.school_student_list');
    Route::post('/student-update/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'updateStudent'])->name('admin.student_update');
    Route::post('/student-delete/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'deleteStudent'])->name('admin.student_delete');
    Route::post('/student-store', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'storeStudent'])->name('admin.student_store');

    Route::get('/debug-admins', function() {
        $adminIds = DB::connection('moodle')->table('config')->where('name', 'siteadmins')->value('value');
        $users = DB::connection('moodle')->table('user')->whereIn('id', explode(',', $adminIds))->get();
        return $users;
    });

    Route::get('/org-detail/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'orgDetail'])->name('admin.org_detail');
    Route::get('/org-detail/{id}/classes', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'classList'])->name('admin.class_list');
    Route::get('/org-detail/{id}/users', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'schoolUserList'])->name('admin.school_user_list');
    
    // School-Course Mapping
    Route::post('/org-detail/{id}/link-course', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'linkCourseStore'])->name('admin.link_course_store');
    Route::post('/org-detail/{id}/unlink-course/{courseId}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'linkCourseDelete'])->name('admin.link_course_delete');
    
    // User Management within Org
    Route::post('/user-store', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'storeUser'])->name('admin.user_store');
    Route::post('/user-update/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'updateUser'])->name('admin.user_update');
    Route::post('/user-delete/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'deleteUser'])->name('admin.user_delete');

    // Class Management
    Route::post('/class-store', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'storeClass'])->name('admin.class_store');
    Route::post('/class-update/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'updateClass'])->name('admin.class_update');
    Route::post('/class-delete/{id}', [App\Http\Controllers\Admin\CompetencyArchitectController::class, 'deleteClass'])->name('admin.class_delete');

    Route::get('/gamification-manager', function () {
        return view('admin.gamification_manager');
    });
});

Route::prefix('principal')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Principal\PrincipalDashboardController::class, 'index'])->name('principal.dashboard');
    Route::get('/student-mastery', [App\Http\Controllers\Principal\PrincipalDashboardController::class, 'studentMastery'])->name('principal.student_mastery');
    Route::get('/excellent-students', [App\Http\Controllers\Principal\PrincipalDashboardController::class, 'excellentStudents'])->name('principal.excellent_students');
    Route::get('/alert-students', [App\Http\Controllers\Principal\PrincipalDashboardController::class, 'alertStudents'])->name('principal.alert_students');
    Route::get('/alert-groups', [App\Http\Controllers\Principal\PrincipalDashboardController::class, 'alertGroups'])->name('principal.alert_groups');

    Route::get('/absent-students', function () {
        return view('principal.absent_students');
    });

    Route::get('/intervention-students', function () {
        return view('principal.intervention_students');
    });

    Route::get('/top-performing-students', function () {
        return view('principal.top_performing_students');
    });
});

Route::prefix('teacher')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Teacher\TeacherDashboardController::class, 'index'])->name('teacher.dashboard');

    Route::get('/low-performing-topics', function () {
        return view('teacher.low_performing_topics');
    });
});

Route::prefix('homeroom')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Homeroom\HomeroomDashboardController::class, 'index'])->name('homeroom.dashboard');

    Route::get('/class-health-details', function () {
        return view('homeroom.class_health_details');
    });

    Route::get('/absent-students', function () {
        return view('homeroom.absent_students');
    });

    Route::get('/intervention-students', function () {
        return view('homeroom.intervention_students');
    });

    Route::get('/top-performing-students', function () {
        return view('homeroom.top_performing_students');
    });
});

Route::prefix('student')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\StudentDashboardController::class, 'index'])->name('student.dashboard');

    Route::get('/growth-details', [App\Http\Controllers\Student\StudentDashboardController::class, 'growthDetails'])->name('student.growth_details');

    Route::get('/excellent-scores', [App\Http\Controllers\Student\StudentDashboardController::class, 'excellentScores'])->name('student.excellent_scores');

    Route::get('/alert-scores', [App\Http\Controllers\Student\StudentDashboardController::class, 'alertScores'])->name('student.alert_scores');

    Route::get('/topic-alerts', [App\Http\Controllers\Student\StudentDashboardController::class, 'topicAlerts'])->name('student.topic_alerts');

    Route::get('/verify-identity', function () {
        return view('student.verify_identity');
    });
});
