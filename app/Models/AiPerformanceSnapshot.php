<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiPerformanceSnapshot extends Model
{
    protected $table = 'ai_performance_snapshots';
    protected $fillable = [
        'user_id', 'course_id', 'baseline_score', 
        'current_score', 'growth_percentage', 'consecutive_growth_count'
    ];

    public function user()
    {
        return $this->belongsTo(MoodleUser::class, 'user_id');
    }
}
