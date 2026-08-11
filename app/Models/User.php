<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'password_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function booted()
    {
        parent::boot();
    }

    private function userConfig()
    {
        return getConfig('user');
    }

    public function setByAdminData($data)
    {
        if (empty($this->sid)) { /* 최초등록 */
            $this->org_code = trim($data['org_code']);
            $this->uid = trim($data['uid']);
            $this->name_kr = trim($data['name_kr']);
            $this->passwordChange($this->uid);
        }

        $this->email = trim($data['email']);
        $this->level = trim($data['level']);
    }

    public function setByData($data)
    {
        $this->email = trim($data['email']);
        $this->passwordChange($data['new_pwd']);
        $this->initial_password = null;
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'org_code', 'org_code');
    }

    public function patients() // 같은 병원에 속환 환자들
    {
        return $this->hasMany(Patient::class, 'org_code', 'org_code');
    }

    public function myPatients() // 내가 등록한 환자들
    {
        return $this->hasMany(Patient::class, 'reg_id', 'uid');
    }

    public function applications() // 타 기관 데이터 신청 정보
    {
        return $this->hasMany(Application::class, 'reg_id', 'uid');
    }

    public function approvals() // 타 기관 데이터 신청 내역 승인 정보 (나에게 신청한정보)
    {
        return $this->hasMany(Approval::class, 'org_code', 'org_code');
    }

    public function passwordHash($password)
    {
        return Hash::check(trim($password), $this->password);
    }

    public function passwordChange($password)
    {
        $password = trim($password);

        $this->password = Hash::make($password);
        $this->password_at = now();
    }

    public function hospitalName()
    {
        return $this->hospital->org_name ?? '';
    }

    public function getLevel()
    {
        return $this->userConfig()['level'][$this->level] ?? '';
    }
}
