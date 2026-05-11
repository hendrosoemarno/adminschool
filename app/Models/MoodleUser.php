<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodleUser extends Model
{
    // Menggunakan koneksi database moodle yang sudah kita definisikan di config/database.php
    protected $connection = 'moodle';
    protected $table = 'user'; // Moodle prefix 'mdlax_' sudah otomatis ditangani oleh config
    
    public $timestamps = false; // Moodle menggunakan Unix timestamp, bukan format default Laravel

    public function badges()
    {
        return $this->hasMany(AiUserBadge::class, 'user_id');
    }

    public function performanceSnapshot()
    {
        return $this->hasOne(AiPerformanceSnapshot::class, 'user_id');
    }
}
