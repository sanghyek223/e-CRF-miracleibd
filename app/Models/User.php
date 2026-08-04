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

    public function setByData($data)
    {
        if (empty($this->sid)) { /* 최초등록 */
            $this->level = $data['level'];
            $this->uid = trim($data['uid']);

            $this->password = $this->passwordChange($data['password']);
        }

        $this->name_kr = trim($data['name_kr']);
        $this->email = trim($data['email']);
        $this->mobile = $data['mobile'];
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
