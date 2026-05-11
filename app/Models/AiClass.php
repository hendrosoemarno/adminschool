<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiClass extends Model
{
    protected $table = 'ai_classes';
    protected $fillable = ['school_id', 'class_name', 'homeroom_teacher_id', 'homeroom_moodle_user_id', 'academic_year'];

    public function school()
    {
        return $this->belongsTo(AiSchool::class, 'school_id');
    }

    // Wali Kelas (Refer to Moodle User)
    public function homeroom()
    {
        return $this->belongsTo(MoodleUser::class, 'homeroom_teacher_id');
    }
}
