<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiBenchmark extends Model
{
    protected $table = 'ai_benchmarks';
    protected $fillable = [
        'course_id', 'school_id', 'competency_id', 'target_national', 
        'target_province', 'target_city', 'target_school', 'academic_year'
    ];

    public function school()
    {
        return $this->belongsTo(AiSchool::class, 'school_id');
    }
}
