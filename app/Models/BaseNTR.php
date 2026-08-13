<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BaseNTR extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Base_NTR_tbl';

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

        static::saving(function ($BaseNTR) {
            if (!isAdmin()) {
                // 마지막 수정자
                $BaseNTR->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($BaseNTR) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $BaseNTR->patient->updateStatusBASE();
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
        $ntrConfig = $baseConfig['NTR'];

        // 영양 인자 설문
        $this->b_NTR_survey = $data['b_NTR_survey'];

        $b_NTR_survey_d = "{$data['b_NTR_survey_d_y']}-{$data['b_NTR_survey_d_m']}-{$data['b_NTR_survey_d_d']}";
        $b_NTR_survey_d_replace = str_replace('-', '', $b_NTR_survey_d);

        if (empty($b_NTR_survey_d_replace)) {
            $b_NTR_survey_d = '';
        }

        $this->b_NTR_survey_d_uk = $data['b_NTR_survey_d_uk'];
        $this->b_NTR_survey_d = (empty($this->b_NTR_survey_d_uk) ? $b_NTR_survey_d : null);

        $this->b_NTR_survey_k = $data['b_NTR_survey_k'];

        // 영양 치료
        $this->b_NTR_Tx = $data['b_NTR_Tx'];
        $this->b_NTR_Tx_k = $data['b_NTR_Tx_k'];

        $is_Tx_k_etc = ($this->b_NTR_Tx_k == '4'); // 영양 치료 병행 방식 기타 식이요법 선택 유무
        $b_NTR_Tx_d = "{$data['b_NTR_Tx_d_y']}-{$data['b_NTR_Tx_d_m']}-{$data['b_NTR_Tx_d_d']}"; // 시행일자
        $b_NTR_Tx_d_replace = str_replace('-', '', $b_NTR_Tx_d);

        if (empty($b_NTR_Tx_d_replace)) {
            $b_NTR_Tx_d = '';
        }

        $this->b_NTR_Tx_ow = ($is_Tx_k_etc) ? $data['b_NTR_Tx_ow'] : null;
        $this->b_NTR_Tx_d_uk = ($is_Tx_k_etc) ? $data['b_NTR_Tx_d_uk'] : '';
        $this->b_NTR_Tx_d = (empty($this->b_NTR_Tx_d_uk) ? $b_NTR_Tx_d : null);

        $this->b_NTR_Tx_stop = $data['b_NTR_Tx_stop'];
        $this->b_NTR_Tx_stop_k = $data['b_NTR_Tx_stop_k'];
        $this->b_NTR_Tx_stop_ow = ($this->b_NTR_Tx_stop_k != '3') ? null : $data['b_NTR_Tx_stop_ow'];

        // 식습관 조사
        $this->b_NTR_alc = $data['b_NTR_alc'];
        $this->b_NTR_S = $data['b_NTR_S'];
        $this->b_NTR_PF = $data['b_NTR_PF'];

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $b_NTR_survey_d = empty($this->b_NTR_survey_d) ? '' : explode('-', $this->b_NTR_survey_d);
        $this->is_survey_uk = (($this->b_NTR_survey_d_uk ?? '') == '1'); // 설문 작성일자 Unknown 체크여부

        $this->b_NTR_survey_d_y = $b_NTR_survey_d[0] ?? '';
        $this->b_NTR_survey_d_m = $b_NTR_survey_d[1] ?? '';
        $this->b_NTR_survey_d_d = $b_NTR_survey_d[2] ?? '';

        $this->is_Tx_k_etc = (($this->b_NTR_Tx_k ?? '') == '4'); // 영양 치료 병행 방식 기타 식이요법 선택

        $b_NTR_Tx_d = empty($this->b_NTR_Tx_d) ? '' : explode('-', $this->b_NTR_Tx_d);
        $this->is_Tx_d_uk = (($this->b_NTR_Tx_d_uk ?? '') == '1'); // 영양 치료 병행 방식 기타 시행일자 Unknown 선택여부

        $this->b_NTR_Tx_d_y = $b_NTR_Tx_d[0] ?? '';
        $this->b_NTR_Tx_d_m = $b_NTR_Tx_d[1] ?? '';
        $this->b_NTR_Tx_d_d = $b_NTR_Tx_d[2] ?? '';

        $this->is_Tx_stop_k_etc = (($this->b_NTR_Tx_stop_k ?? '') == '3'); // 영양 치료 중단 사유 기타 선택

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
