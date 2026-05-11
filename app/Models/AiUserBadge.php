<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiUserBadge extends Model
{
    protected $table = 'ai_user_badges';
    protected $fillable = ['user_id', 'badge_id', 'quiz_id_trigger', 'earned_at'];
    
    public $timestamps = false; // Menggunakan earned_at manual

    public function badge()
    {
        return $this->belongsTo(AiBadge::class, 'badge_id');
    }

    public function user()
    {
        return $this->belongsTo(MoodleUser::class, 'user_id');
    }
}
