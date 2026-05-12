<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiKkmSetting extends Model
{
    protected $table = 'ai_kkm_settings';
    protected $fillable = ['school_id', 'course_id', 'competency_id', 'min_score'];

    public function school()
    {
        return $this->belongsTo(AiSchool::class, 'school_id');
    }
}
