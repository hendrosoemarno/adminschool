<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ai_quiz_allocations', function (Blueprint $table) {
            $table->id();
            $table->integer('moodle_quiz_id');
            $table->unsignedBigInteger('competency_id');
            $table->string('category')->default('TRYOUT'); // TRYOUT, HARIAN, EVALUASI
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_quiz_allocations');
    }
};
