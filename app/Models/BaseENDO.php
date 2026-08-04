<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BaseENDO extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Base_endo_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected ?array $registerConfig = null;

    protected ?array $baseConfig = null;

    protected static function booted()
    {
        parent::boot();

        static::saving(function ($BaseENDO) {
            if (checkUrl() !== 'admin') {
                // 마지막 수정자
                $BaseENDO->last_reg_id = thisUser()->uid;
            }

            $patient = $BaseENDO->patient;
            $patient->updateStatusBASE();
        });
    }

    private function registerConfig()
    {
        if (is_null($this->registerConfig)) {
            $this->registerConfig = config("site.register");
        }

        return $this->registerConfig;
    }

    private function baseConfig()
    {
        if (is_null($this->baseConfig)) {
            $this->baseConfig = $this->registerConfig()['BASE'];
        }

        return $this->baseConfig;
    }

    public function setByData($data)
    {
        $baseConfig = $this->baseConfig();
        $endoConfig = $baseConfig['ENDO'];
        $BaseDX = $this->patient->BaseDX->additionalData(); // 진단 시점 정보


        $b_endo_d = "{$data['b_endo_d_y']}-{$data['b_endo_d_m']}-{$data['b_endo_d_d']}";
        $this->b_endo_d_uk = $data['b_endo_d_uk'];
        $this->b_endo_d = (empty($this->b_endo_d_uk) ? $b_endo_d : null);

        $this->b_MES = ($BaseDX->is_uc ? $data['b_MES'] : null); // MES (UC인 경우)
        $this->b_SES_CD = ($BaseDX->is_cd ? $data['b_SES_CD'] : null); // SES-CD (CD인 경우)

        $this->b_endo_sev = $data['b_endo_sev'];

        $b_entero_d = "{$data['b_entero_d_y']}-{$data['b_entero_d_m']}-{$data['b_entero_d_d']}";
        $this->b_entero_d_uk = $data['b_entero_d_uk'];
        $this->b_entero_d = (empty($this->b_entero_d_uk) ? $b_entero_d : null);

        $this->b_entero_sev = $data['b_entero_sev'];

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $b_endo_d = empty($this->b_endo_d) ? '' : explode('-', $this->b_endo_d);

        $this->b_endo_d_y = $b_endo_d[0] ?? '';
        $this->b_endo_d_m = $b_endo_d[1] ?? '';
        $this->b_endo_d_d = $b_endo_d[2] ?? '';

        $b_entero_d = empty($this->b_entero_d) ? '' : explode('-', $this->b_entero_d);

        $this->b_entero_d_y = $b_entero_d[0] ?? '';
        $this->b_entero_d_m = $b_entero_d[1] ?? '';
        $this->b_entero_d_d = $b_entero_d[2] ?? '';

        $this->is_endo_uk = (($this->b_endo_d_uk ?? '') == '1'); // 최초 내시경 검사일 Unknown 체크여부
        $this->is_entero_uk = (($this->b_entero_d_uk ?? '') == '1'); // 최초 소장내시경 검사일 Unknown 체크여부

        return $this;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'regist_num', 'regist_num')->withTrashed();
    }

    public function getRegStatusName()
    {
        return $this->registerConfig()['status'][$this->status ?? '']['name'] ?? '';
    }

    public function getRegStatusClass()
    {
        $status = $this->getRegStatus();
        return $this->registerConfig()['status'][$this->status ?? '']['class'] ?? '';
    }
}
