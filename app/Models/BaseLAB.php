<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BaseLAB extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Base_lab_tbl';

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

        static::saving(function ($BaseLAB) {
            if (!isAdmin()) {
                // 마지막 수정자
                $BaseLAB->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($BaseLAB) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $BaseLAB->patient->updateStatusBASE();
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
        $this->b_lab_WBC_na = $data['b_lab_WBC_na'];
        $this->b_lab_WBC = empty($this->b_lab_WBC_na) ? $data['b_lab_WBC'] : null;

        $this->b_lab_Hb_na = $data['b_lab_Hb_na'];
        $this->b_lab_Hb = empty($this->b_lab_Hb_na) ? $data['b_lab_Hb'] : null;

        $this->b_lab_ESR_na = $data['b_lab_ESR_na'];
        $this->b_lab_ESR = empty($this->b_lab_ESR_na) ? $data['b_lab_ESR'] : null;

        $this->b_lab_Alb_na = $data['b_lab_Alb_na'];
        $this->b_lab_Alb = empty($this->b_lab_Alb_na) ? $data['b_lab_Alb'] : null;

        $this->b_lab_CRP_na = $data['b_lab_CRP_na'];
        $this->b_lab_CRP = empty($this->b_lab_CRP_na) ? $data['b_lab_CRP'] : null;

        $this->b_lab_FC_na = $data['b_lab_FC_na'];
        $this->b_lab_FC = empty($this->b_lab_FC_na) ? $data['b_lab_FC'] : null;

        $this->b_lab_IgG = $data['b_lab_IgG'];
        $this->b_lab_IgG_QN_na = $data['b_lab_IgG_QN_na'];
        $this->b_lab_IgG_QN = empty($this->b_lab_IgG_QN_na) ? $data['b_lab_IgG_QN'] : null;

        $this->b_lab_IgA = $data['b_lab_IgA'];
        $this->b_lab_IgA_QN_na = $data['b_lab_IgA_QN_na'];
        $this->b_lab_IgA_QN = empty($this->b_lab_IgA_QN_na) ? $data['b_lab_IgA_QN'] : null;

        $this->b_lab_IgG_cat = $data['b_lab_IgG_cat'];
        $this->b_lab_IgA_cat = $data['b_lab_IgA_cat'];
        $this->b_lab_ASCA_total = $data['b_lab_ASCA_total'];
        $this->b_lab_ANCA = $data['b_lab_ANCA'];

        $this->b_lab_ANCA_QN_na = $data['b_lab_ANCA_QN_na'];
        $this->b_lab_ANCA_QN = empty($this->b_lab_ANCA_QN_na) ? $data['b_lab_ANCA_QN'] : null;

        $this->b_lab_VitD_na = $data['b_lab_VitD_na'];
        $this->b_lab_VitD = empty($this->b_lab_VitD_na) ? $data['b_lab_VitD'] : null;

        $this->b_lab_folate_na = $data['b_lab_folate_na'];
        $this->b_lab_folate = empty($this->b_lab_folate_na) ? $data['b_lab_folate'] : null;

        $this->b_lab_B12_na = $data['b_lab_B12_na'];
        $this->b_lab_B12 = empty($this->b_lab_B12_na) ? $data['b_lab_B12'] : null;

        $this->b_lab_Cdiff_toxin = $data['b_lab_Cdiff_toxin'];
        $this->b_lab_Cdiff_CPR = $data['b_lab_Cdiff_CPR'];
        $this->b_lab_bi_toxin = $data['b_lab_bi_toxin'];
        $this->b_lab_TcDc_del = $data['b_lab_TcDc_del'];

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $this->is_WBC_na = !empty($this->b_lab_WBC_na); // WBC N/A 체크 유무
        $this->is_Hb_na = !empty($this->b_lab_Hb_na); // Hemoglobin N/A 체크 유무
        $this->is_ESR_na = !empty($this->b_lab_ESR_na); // ESR N/A 체크 유무
        $this->is_Alb_na = !empty($this->b_lab_Alb_na); // Albumin N/A 체크 유무
        $this->is_CRP_na = !empty($this->b_lab_CRP_na); // CRP N/A 체크 유무
        $this->is_FC_na = !empty($this->b_lab_FC_na); // Fecal Calprotectin N/A 체크 유무
        $this->is_IgG_QN_na = !empty($this->b_lab_IgG_QN_na); // ASCA IgG 정량 N/A 체크 유무
        $this->is_IgA_QN_na = !empty($this->b_lab_IgA_QN_na); // ASCA IgA 정량 N/A 체크 유무
        $this->is_ANCA_QN_na = !empty($this->b_lab_ANCA_QN_na); // ANCA 정량 N/A 체크 유무
        $this->is_VitD_na = !empty($this->b_lab_VitD_na); // Vitamin D N/A 체크 유무
        $this->is_folate_na = !empty($this->b_lab_folate_na); // Folate N/A 체크 유무
        $this->is_B12_na = !empty($this->b_lab_B12_na); // Vitamin B12 N/A 체크 유무

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
