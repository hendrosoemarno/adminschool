<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiCompetencyMapping extends Model
{
    protected $table = 'ai_competency_mapping';
    protected $fillable = ['moodle_category_id', 'competency_id', 'mapping_type'];

    public function competency()
    {
        if ($this->mapping_type === 'reguler') {
            return $this->belongsTo(AiCompetencyReguler::class, 'competency_id');
        }
        return $this->belongsTo(AiCompetencyDeep::class, 'competency_id');
    }
}
