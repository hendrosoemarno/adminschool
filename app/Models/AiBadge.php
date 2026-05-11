<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiBadge extends Model
{
    protected $table = 'ai_badges';
    protected $fillable = ['badge_name', 'course_id', 'badge_type', 'description', 'icon_path'];

    public function earners()
    {
        return $this->hasMany(AiUserBadge::class, 'badge_id');
    }
}
