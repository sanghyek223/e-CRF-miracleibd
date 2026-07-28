<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'patient_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [];

    protected ?array $patientConfig = null;

    protected static function booted()
    {
        parent::boot();

        static::created(function ($patient) {
            $org_code = $patient->org_code;

            $orgPnum = self::withTrashed()->where('org_code', $org_code)->max('orgPnum') ?? 0;

            do {
                $orgPnum++;
                $patient->orgPnum = $orgPnum;
                $patient->regist_num = "{$org_code}-" . addZero($orgPnum, 4);
            } while (self::withTrashed()->where(['org_code' => $org_code, 'regist_num' => $patient->regist_num])->exists());

            $patient->saveQuietly();
        });

        static::updating(function ($patient) {
            if (checkUrl() !== 'admin') {
                // 마지막 수정자
                $patient->last_reg_id = thisUser()->uid;
            }
        });

        // 삭제시
        static::deleting(function ($patient) {
            optional($patient->base)->delete();
            optional($patient->pre)->delete();
            optional($patient->outcome)->delete();
            optional($patient->tx)->delete();
        });

        // 복원시
        static::restoring(function ($patient) {
            optional($patient->base)->restore();
            optional($patient->pre)->restore();
            optional($patient->outcome)->restore();
            optional($patient->tx)->restore();
        });
    }

    private function patientConfig()
    {
        if (is_null($this->patientConfig)) {
            $this->patientConfig = config("site.patient");
        }

        return $this->patientConfig;
    }

    public function setByData($data)
    {
        if (empty($this->sid)) {
            $user = thisUser(); // 로그인 사용자

            $this->reg_id = $user->uid;
            $this->org_code = $user->org_code;
            $this->org_name = $user->hospitalName();
        }

        $birth = "{$data['birth_date_y']}-{$data['birth_date_m']}-{$data['birth_date_d']}";

        $this->initial = $data['initial'];
        $this->sex = $data['sex'];
        $this->birth_d = $birth;
        $this->arrival_chk = $data['arrival_chk'];
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $birthArr = empty($this->birth_d) ? '' : explode('-', $this->birth_d);

        $this->birth_date_y = $birthArr[0] ?? '';
        $this->birth_date_m = $birthArr[1] ?? '';
        $this->birth_date_d = $birthArr[2] ?? '';
        
        return $this;
    }

    public function user() // 등록자
    {
        return $this->belongsTo(User::class, 'reg_id', 'uid');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'org_code', 'org_code');
    }

    public function hospitalName()
    {
        return $this->hospital->org_name ?? '';
    }

    public function getSex()
    {
        $str = $this->patientConfig()['sex'][$this->sex ?? ''] ?? '';

        return empty($str)
            ? ''
            : mb_substr($str, 0, -1, 'UTF-8');
    }
}