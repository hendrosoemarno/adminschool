<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiSchool extends Model
{
    protected $table = 'ai_schools';
    protected $fillable = ['npsn', 'school_name', 'jenjang', 'address', 'principal_name'];

    public function classes()
    {
        return $this->hasMany(AiClass::class, 'school_id');
    }

    public function kkmSettings()
    {
        return $this->hasMany(AiKkmSetting::class, 'school_id');
    }
}
