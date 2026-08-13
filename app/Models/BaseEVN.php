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
            if (!isAdmin()) {
                // 마지막 수정자
                $BaseEVN->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($BaseEVN) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $BaseEVN->patient->updateStatusBASE();
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

    public function getExcelField()
    {
        $except = ['sid', 'last_reg_id', 'regist_num', 'status', 'created_at', 'updated_at', 'deleted_at'];
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable());

        return array_values(array_diff($columns, $except));
    }
    
    public function setByData($data)
    {
        $baseConfig = $this->baseConfig();
        $evnConfig = $baseConfig['EVN'];

        $b_EVN_survey_d = "{$data['b_EVN_survey_d_y']}-{$data['b_EVN_survey_d_m']}-{$data['b_EVN_survey_d_d']}"; // 설문지 작성일자
        $b_EVN_survey_d_replace = str_replace('-', '', $b_EVN_survey_d);

        if (empty($b_EVN_survey_d_replace)) {
            $b_EVN_survey_d = '';
        }

        // 환경 인자 설문
        $this->b_EVN_survey = $data['b_EVN_survey'];
        $this->b_EVN_survey_d_uk = $data['b_EVN_survey_d_uk'];
        $this->b_EVN_survey_d = ($this->b_EVN_survey == '1' && empty($this->b_EVN_survey_d_uk)) ? $b_EVN_survey_d : null;

        // 일상 활동 정도
        $this->b_EVN_E1q = $data['b_EVN_E1q'];
        $this->b_EVN_E1q_ow = ($this->b_EVN_E1q == '5') ? $data['b_EVN_E1q_ow'] : null;

        // 모유 수유 / 출산력
        $this->b_EVN_B1q = $data['b_EVN_B1q'];
        $this->b_EVN_B1q_1 = ($this->b_EVN_B1q == '1') ? $data['b_EVN_B1q_1'] : null;
        $this->b_EVN_B2q = $data['b_EVN_B2q'];


        // 어린시절 병력
        $this->b_EVN_PH1q = $data['b_EVN_PH1q'];

        $this->b_EVN_PH2q_1 = $data['b_EVN_PH2q_1'];
        $this->b_EVN_PH2q_2 = $data['b_EVN_PH2q_2'];
        $this->b_EVN_PH2q_3 = $data['b_EVN_PH2q_3'];
        $this->b_EVN_PH2q_4 = $data['b_EVN_PH2q_4'];
        $this->b_EVN_PH2q_5 = $data['b_EVN_PH2q_5'];
        $this->b_EVN_PH2q_6 = $data['b_EVN_PH2q_6'];

        $this->b_EVN_PH3q_1 = $data['b_EVN_PH3q_1'];
        $this->b_EVN_PH3q_2 = $data['b_EVN_PH3q_2'];
        $this->b_EVN_PH3q_3 = $data['b_EVN_PH3q_3'];
        $this->b_EVN_PH3q_4 = $data['b_EVN_PH3q_4'];
        $this->b_EVN_PH3q_5 = $data['b_EVN_PH3q_5'];
        $this->b_EVN_PH3q_6 = $data['b_EVN_PH3q_6'];
        $this->b_EVN_PH3q_7 = $data['b_EVN_PH3q_7'];

        // 반려 동물
        $this->b_EVN_P1q = $data['b_EVN_P1q'];
        $is_P1q_y = ($this->b_EVN_P1q == '1');

        $this->b_EVN_P1q_1 = ($is_P1q_y) ? $data['b_EVN_P1q_1'] : null;
        $this->b_EVN_P1q_2 = ($is_P1q_y) ? $data['b_EVN_P1q_2'] : null;
        $this->b_EVN_P1q_3 = ($is_P1q_y) ? $data['b_EVN_P1q_3'] : null;
        $this->b_EVN_P1q_4 = ($is_P1q_y) ? $data['b_EVN_P1q_4'] : null;
        $this->b_EVN_P1q_5 = ($is_P1q_y) ? $data['b_EVN_P1q_5'] : null;
        $this->b_EVN_P1q_6 = ($is_P1q_y) ? $data['b_EVN_P1q_6'] : null;
        $this->b_EVN_P1q_6_ow = ($is_P1q_y && !empty($this->b_EVN_P1q_6)) ? $data['b_EVN_P1q_6_ow'] : null;

        $this->b_EVN_P1q_1_p = (!empty($this->b_EVN_P1q_1)) ? $data['b_EVN_P1q_1_p'] : null;
        $this->b_EVN_P1q_2_p = (!empty($this->b_EVN_P1q_2)) ? $data['b_EVN_P1q_2_p'] : null;
        $this->b_EVN_P1q_3_p = (!empty($this->b_EVN_P1q_3)) ? $data['b_EVN_P1q_3_p'] : null;
        $this->b_EVN_P1q_4_p = (!empty($this->b_EVN_P1q_4)) ? $data['b_EVN_P1q_4_p'] : null;
        $this->b_EVN_P1q_5_p = (!empty($this->b_EVN_P1q_5)) ? $data['b_EVN_P1q_5_p'] : null;
        $this->b_EVN_P1q_6_p = (!empty($this->b_EVN_P1q_6)) ? $data['b_EVN_P1q_6_p'] : null;

        $this->b_EVN_P2q = $data['b_EVN_P2q'];
        $is_P2q_y = ($this->b_EVN_P2q == '1');

        $this->b_EVN_P2q_1 = ($is_P2q_y) ? $data['b_EVN_P2q_1'] : null;
        $this->b_EVN_P2q_2 = ($is_P2q_y) ? $data['b_EVN_P2q_2'] : null;
        $this->b_EVN_P2q_3 = ($is_P2q_y) ? $data['b_EVN_P2q_3'] : null;
        $this->b_EVN_P2q_4 = ($is_P2q_y) ? $data['b_EVN_P2q_4'] : null;
        $this->b_EVN_P2q_5 = ($is_P2q_y) ? $data['b_EVN_P2q_5'] : null;
        $this->b_EVN_P2q_6 = ($is_P2q_y) ? $data['b_EVN_P2q_6'] : null;
        $this->b_EVN_P2q_6_ow = ($is_P2q_y && !empty($this->b_EVN_P2q_6)) ? $data['b_EVN_P2q_6_ow'] : null;

        $this->b_EVN_P2q_1_p = (!empty($this->b_EVN_P2q_1)) ? $data['b_EVN_P2q_1_p'] : null;
        $this->b_EVN_P2q_2_p = (!empty($this->b_EVN_P2q_2)) ? $data['b_EVN_P2q_2_p'] : null;
        $this->b_EVN_P2q_3_p = (!empty($this->b_EVN_P2q_3)) ? $data['b_EVN_P2q_3_p'] : null;
        $this->b_EVN_P2q_4_p = (!empty($this->b_EVN_P2q_4)) ? $data['b_EVN_P2q_4_p'] : null;
        $this->b_EVN_P2q_5_p = (!empty($this->b_EVN_P2q_5)) ? $data['b_EVN_P2q_5_p'] : null;
        $this->b_EVN_P2q_6_p = (!empty($this->b_EVN_P2q_6)) ? $data['b_EVN_P2q_6_p'] : null;

        // 동거 가족 및 거주
        $this->b_EVN_FH1q = $data['b_EVN_FH1q'];
        $this->b_EVN_FH2q = $data['b_EVN_FH2q'];
        $this->b_EVN_FH3q = $data['b_EVN_FH3q'];
        $this->b_EVN_FH3q_1 = ($this->b_EVN_FH3q == '1') ? $data['b_EVN_FH3q_1'] : null;
        $this->b_EVN_FH4q = $data['b_EVN_FH4q'];
        $this->b_EVN_FH4q_1 = ($this->b_EVN_FH4q == '1') ? $data['b_EVN_FH4q_1'] : null;
        $this->b_EVN_FH5q = $data['b_EVN_FH5q'];

        // 진단 전 수술 병력
        $this->b_EVN_OP1q = $data['b_EVN_OP1q'];
        $this->b_EVN_OP1q_1 = ($this->b_EVN_OP1q == '1') ? $data['b_EVN_OP1q_1'] : null;
        $this->b_EVN_OP2q = $data['b_EVN_OP2q'];
        $this->b_EVN_OP2q_1 = ($this->b_EVN_OP2q == '1') ? $data['b_EVN_OP2q_1'] : null;

        // 약제 사용력
        $this->b_EVN_M1q = $data['b_EVN_M1q'];
        $this->b_EVN_M1q_1 = ($this->b_EVN_M1q == '1') ? $data['b_EVN_M1q_1'] : null;
        $this->b_EVN_M2q = $data['b_EVN_M2q'];
        $this->b_EVN_M2q_1 = ($this->b_EVN_M2q == '1') ? $data['b_EVN_M2q_1'] : null;
        $this->b_EVN_M3q = $data['b_EVN_M3q'];

        // 수면
        $this->b_EVN_S1q = $data['b_EVN_S1q'];
        $this->b_EVN_S2q = $data['b_EVN_S2q'];

        // COVID 19 (코로나19 바이러스 감염증)
        $this->b_EVN_C1q = $data['b_EVN_C1q'];
        $is_C1q_y = ($this->b_EVN_C1q == '1');

        $this->b_EVN_C1q_1_uk = ($is_C1q_y) ? $data['b_EVN_C1q_1_uk'] : null;
        $this->b_EVN_C1q_1_year = ($is_C1q_y && empty($this->b_EVN_C1q_1_uk)) ? $data['b_EVN_C1q_1_year'] : null;
        $this->b_EVN_C1q_1_month = ($is_C1q_y && empty($this->b_EVN_C1q_1_uk)) ? $data['b_EVN_C1q_1_month'] : null;
        $this->b_EVN_C2q = $data['b_EVN_C2q'];

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        // 환경 인자 설문
        $this->is_survey_y = ($this->b_EVN_survey == '1');

        $b_EVN_survey_d = empty($this->b_EVN_survey_d) ? '' : explode('-', $this->b_EVN_survey_d);
        $this->is_survey_uk = (($this->b_EVN_survey_d_uk ?? '') == '1'); // 설문지 작성일자 Unknown 체크여부

        $this->b_EVN_survey_d_y = $b_EVN_survey_d[0] ?? '';
        $this->b_EVN_survey_d_m = $b_EVN_survey_d[1] ?? '';
        $this->b_EVN_survey_d_d = $b_EVN_survey_d[2] ?? '';

        // 일상 활동 정도
        $this->is_E1q_etc = ($this->b_EVN_E1q == '5'); // 일상 활동 정도 직접기술 선택

        // 모유 수유 / 출산력
        $this->is_B1q = ($this->b_EVN_B1q == '1'); // 어릴 때 모유 수유를 하셨나요? - 예

        // 반려 동물
        $this->is_P1q_y = ($this->b_EVN_P1q == '1'); // 1. 현재 반려동물을 기르고 있습니까? - 예
        $this->is_P2q_y = ($this->b_EVN_P2q == '1'); // 2. 어린 시절 반려동물을 기른 적이 있습니까?

        // 동거 가족 및 거주
        $this->is_FH3q_y = ($this->b_EVN_FH3q == '1'); // 3. 영유아기(0~6세)에 조부모가 1년 이상 나를 키워주셨나요? - 예
        $this->is_FH4q_y = ($this->b_EVN_FH4q == '1'); // 4. 염증성 장질환을 가진 환자와 현재 동거 중 인가요? - 예

        // 진단 전 수술 병력
        $this->is_OP1q_y = ($this->b_EVN_OP1q == '1'); // 1. 진단 전에 충수돌기 절제술(맹장 수술)을 받은 적이 있나요? - 예
        $this->is_OP2q_y = ($this->b_EVN_OP2q == '1'); // 2. 진단 전에 편도선 절제술을 받은 적이 있나요? - 예

        // 약제 사용력
        $this->is_M1q_y = ($this->b_EVN_M1q == '1'); // 1. 어린 시절 항생제 치료를 1주 이상 지속한 적이 있나요? - 예
        $this->is_M2q_y = ($this->b_EVN_M2q == '1'); // 2. 진단 시점 이전 항생제 치료를 1주 이상 지속한 적이 있나요? - 예

        // COVID 19 (코로나19 바이러스 감염증)
        $this->is_C1q_y = ($this->b_EVN_C1q == '1'); // 1. COVID 19에 감염된 적이 있나요? - 예
        $this->is_C1q_1_uk = ($this->b_EVN_C1q_1_uk == '1'); // 1-1. COVID 19에 감염되었다면 감염이 확인된 일자는 언제인가요? (확진일 기준) Unknown 체크

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
