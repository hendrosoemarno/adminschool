<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiCompetencyMapping extends Model
{
    protected $table = 'ai_competency_mapping';

    protected $fillable = ['moodle_category_id', 'competency_id'];

    public function competency()
    {
        return $this->belongsTo(AiCompetency::class, 'competency_id');
    }
}
