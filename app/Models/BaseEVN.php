<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BaseEVN extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Base_EVN_tbl';

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

        static::saving(function ($BaseEVN) {
            if (checkUrl() !== 'admin') {
                // 마지막 수정자
                $BaseEVN->last_reg_id = thisUser()->uid;
            }

            $patient = $BaseEVN->patient;
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
        $evnConfig = $baseConfig['EVN'];

        // 환경 인자 설문
        $b_EVN_survey_d = "{$data['b_EVN_survey_d_y']}-{$data['b_EVN_survey_d_m']}-{$data['b_EVN_survey_d_d']}"; // 설문지 작성일자
        $b_EVN_survey_d_replace = str_replace('-', '', $b_EVN_survey_d);

        if (empty($b_EVN_survey_d_replace)) {
            $b_EVN_survey_d = '';
        }

        $this->b_EVN_survey = $data['b_EVN_survey'];
        $this->b_EVN_survey_d_uk = $data['b_EVN_survey_d_uk'];
        $this->b_EVN_survey_d = (($this->b_EVN_survey ?? '') == '1' && empty($this->b_EVN_survey_d_uk)) ? $b_EVN_survey_d : null;
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $this->is_survey_y = ($this->b_EVN_survey == '1');

        $b_EVN_survey_d = empty($this->b_EVN_survey_d) ? '' : explode('-', $this->b_EVN_survey_d);
        $this->is_survey_uk = (($this->b_EVN_survey_d_uk ?? '') == '1'); // 설문지 작성일자 Unknown 체크여부

        $this->b_EVN_survey_d_y = $b_EVN_survey_d[0] ?? '';
        $this->b_EVN_survey_d_m = $b_EVN_survey_d[1] ?? '';
        $this->b_EVN_survey_d_d = $b_EVN_survey_d[2] ?? '';

        $this->is_E1q_etc = ($this->b_EVN_E1q == '5'); // 일상 활동 정도 직접기술 선택
        $this->is_B1q = ($this->b_EVN_B1q == '1'); // 어릴 때 모유 수유를 하셨나요? - 예

        $this->b_EVN_P1q_etc = ($this->b_EVN_P1q6 == '1'); // 1-1. 현재 기르고 있는 반려 동물을 모두 선택해 주세요. - 기타
        $this->b_EVN_P2q_etc = ($this->b_EVN_P2q6 == '1'); // 2-1. 어린 시절 길렀던 반려 동물을 모두 선택해 주세요. - 기타

        $this->FH3q_y = ($this->b_EVN_FH3q == '1'); // 3. 영유아기(0~6세)에 조부모가 1년 이상 나를 키워주셨나요? - 예
        $this->FH4q_y = ($this->b_EVN_FH4q == '1'); // 4. 염증성 장질환을 가진 환자와 현재 동거 중 인가요? - 예

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
