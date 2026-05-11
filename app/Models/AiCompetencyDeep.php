<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiCompetencyDeep extends Model
{
    protected $table = 'ai_competencies_deep';
    protected $fillable = ['course_id', 'topic_name', 'topic_code'];

    public function mapping()
    {
        return $this->hasOne(AiCompetencyMapping::class, 'competency_id')->where('mapping_type', 'deep');
    }
}
