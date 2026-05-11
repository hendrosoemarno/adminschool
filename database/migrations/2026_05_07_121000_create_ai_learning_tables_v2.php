<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. School Profiles
        Schema::create('ai_schools', function (Blueprint $table) {
            $table->id();
            $table->string('npsn')->unique();
            $table->string('school_name');
            $table->text('address')->nullable();
            $table->string('principal_name')->nullable();
            $table->timestamps();
        });

        // 2. Class Profiles & Homeroom
        Schema::create('ai_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('ai_schools')->onDelete('cascade');
            $table->string('class_name');
            $table->unsignedBigInteger('homeroom_teacher_id'); // Link to mdl_user.id
            $table->string('academic_year')->nullable();
            $table->timestamps();
        });

        // 3. Master Competencies - Reguler Track (Subject > Topic)
        Schema::create('ai_competencies_reguler', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // Link to mdl_course.id
            $table->string('topic_name');
            $table->string('topic_code')->nullable();
            $table->timestamps();
        });

        // 4. Master Competencies - Deep/Micro-skill Track (Subject > Topic)
        Schema::create('ai_competencies_deep', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // Link to mdl_course.id
            $table->string('topic_name');
            $table->string('topic_code')->nullable();
            $table->timestamps();
        });

        // 5. Mapping Moodle Categories to AI Competencies
        Schema::create('ai_competency_mapping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moodle_category_id'); // Link to mdl_question_categories.id
            $table->unsignedBigInteger('competency_id');
            $table->enum('mapping_type', ['reguler', 'deep']);
            $table->timestamps();
            $table->unique(['moodle_category_id', 'mapping_type'], 'category_mapping_unique');
        });

        // 6. KKM Settings (Threshold for ALERT status)
        Schema::create('ai_kkm_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('ai_schools')->onDelete('cascade');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('competency_id')->nullable();
            $table->decimal('min_score', 5, 2)->default(75.00);
            $table->enum('mapping_type', ['reguler', 'deep'])->default('reguler');
            $table->timestamps();
        });

        // 7. Benchmarks (Threshold for EXCELLENT status + Knowledge Base)
        Schema::create('ai_benchmarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->foreignId('school_id')->constrained('ai_schools')->onDelete('cascade');
            $table->decimal('target_national', 5, 2)->nullable();
            $table->decimal('target_province', 5, 2)->nullable();
            $table->decimal('target_city', 5, 2)->nullable();
            $table->decimal('target_school', 5, 2); // Main threshold for Excellent
            $table->string('academic_year')->nullable();
            $table->timestamps();
        });

        // 8. Badge Master (Gamification)
        Schema::create('ai_badges', function (Blueprint $table) {
            $table->id();
            $table->string('badge_name');
            $table->unsignedBigInteger('course_id');
            $table->enum('badge_type', ['growth', 'excellent', 'participation']);
            $table->text('description')->nullable();
            $table->string('icon_path')->nullable();
            $table->timestamps();
        });

        // 9. User Badge Log
        Schema::create('ai_user_badges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Link to mdl_user.id
            $table->foreignId('badge_id')->constrained('ai_badges')->onDelete('cascade');
            $table->unsignedBigInteger('quiz_id_trigger')->nullable();
            $table->timestamp('earned_at')->useCurrent();
        });

        // 10. Performance Snapshots (Cache for fast Dashboards)
        Schema::create('ai_performance_snapshots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->decimal('baseline_score', 5, 2)->nullable();
            $table->decimal('current_score', 5, 2)->nullable();
            $table->decimal('growth_percentage', 5, 2)->nullable();
            $table->integer('consecutive_growth_count')->default(0); // For Hat-trick tracking
            $table->timestamps();
            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_performance_snapshots');
        Schema::dropIfExists('ai_user_badges');
        Schema::dropIfExists('ai_badges');
        Schema::dropIfExists('ai_benchmarks');
        Schema::dropIfExists('ai_kkm_settings');
        Schema::dropIfExists('ai_competency_mapping');
        Schema::dropIfExists('ai_competencies_deep');
        Schema::dropIfExists('ai_competencies_reguler');
        Schema::dropIfExists('ai_classes');
        Schema::dropIfExists('ai_schools');
    }
};
