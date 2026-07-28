<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospital_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [];

    protected static function booted()
    {
        parent::boot();
    }

    public function users() // 병원에 속한 연구자들
    {
        return $this->hasMany(User::class, 'org_code', 'org_code');
    }

    public function patients() // 병원에 속환 환자들
    {
        return $this->hasMany(Patient::class, 'org_code', 'org_code');
    }
}