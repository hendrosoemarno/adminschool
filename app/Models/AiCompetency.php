<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiCompetency extends Model
{
    protected $table = 'ai_competencies';

    protected $fillable = [
        'course_id', 'topic_name', 'topic_code',
        'type', 'parent_id', 'jenjang',
        'weight'
    ];

    public function mapping()
    {
        return $this->hasOne(AiCompetencyMapping::class, 'competency_id');
    }

    public function parent()
    {
        return $this->belongsTo(AiCompetency::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(AiCompetency::class, 'parent_id');
    }
}
