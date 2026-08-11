<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FuLAB extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'FU_lab_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected ?array $registerConfig = null;

    protected ?array $fuConfig = null;

    protected static function booted()
    {
        parent::boot();

        static::saving(function ($FuLAB) {
            if (!isAdmin()) {
                // 마지막 수정자
                $FuLAB->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($FuLAB) {
            $Fu = $FuLAB->Fu;

            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $Fu->update([
                'status_FU_lab' => $FuLAB->status,
            ]);

            $Fu->updateFuStatus();
        });
    }

    private function registerConfig()
    {
        if (is_null($this->registerConfig)) {
            $this->registerConfig = config("site.register");
        }

        return $this->registerConfig;
    }

    private function fuConfig()
    {
        if (is_null($this->fuConfig)) {
            $this->fuConfig = $this->registerConfig()['FU'];
        }

        return $this->fuConfig;
    }

    public function setByData($data)
    {
        $fuConfig = $this->fuConfig();
        $labConfig = $fuConfig['LAB'];

        $this->FU_lab_WBC_na = $data['FU_lab_WBC_na'];
        $this->FU_lab_WBC = ($this->FU_lab_WBC != '1') ? $data['FU_lab_WBC'] : null;

        $this->FU_lab_Hb_na = $data['FU_lab_Hb_na'];
        $this->FU_lab_Hb = ($this->FU_lab_Hb != '1') ? $data['FU_lab_Hb'] : null;

        $this->FU_lab_ESR_na = $data['FU_lab_ESR_na'];
        $this->FU_lab_ESR = ($this->FU_lab_ESR != '1') ? $data['FU_lab_ESR'] : null;

        $this->FU_lab_CRP_na = $data['FU_lab_CRP_na'];
        $this->FU_lab_CRP = ($this->FU_lab_CRP != '1') ? $data['FU_lab_CRP'] : null;
        $this->FU_lab_CRP_cat = $data['FU_lab_CRP_cat'];

        $this->FU_lab_alb_na = $data['FU_lab_alb_na'];
        $this->FU_lab_alb = ($this->FU_lab_alb != '1') ? $data['FU_lab_alb'] : null;

        $this->FU_lab_FC_na = $data['FU_lab_FC_na'];
        $this->FU_lab_FC = ($this->FU_lab_FC != '1') ? $data['FU_lab_FC'] : null;
        $this->FU_lab_FC_cat = $data['FU_lab_FC_cat'];

        $this->FU_lab_IgG_QN_na = $data['FU_lab_IgG_QN_na'];
        $this->FU_lab_IgG_QN = ($this->FU_lab_IgG_QN != '1') ? $data['FU_lab_IgG_QN'] : null;
        $this->FU_lab_IgG_cat1 = $data['FU_lab_IgG_cat1'];
        $this->FU_lab_IgG_cat2 = $data['FU_lab_IgG_cat2'];

        $this->FU_lab_IgA_QN_na = $data['FU_lab_IgA_QN_na'];
        $this->FU_lab_IgA_QN = ($this->FU_lab_IgA_QN != '1') ? $data['FU_lab_IgA_QN'] : null;
        $this->FU_lab_IgA_cat1 = $data['FU_lab_IgA_cat1'];
        $this->FU_lab_IgA_cat2 = $data['FU_lab_IgA_cat2'];

        $this->FU_lab_ANCA = $data['FU_lab_ANCA'];

        $this->FU_lab_ANCA_total_na = $data['FU_lab_ANCA_total_na'];
        $this->FU_lab_ANCA_total = ($this->FU_lab_ANCA_total != '1') ? $data['FU_lab_ANCA_total'] : null;

        $this->FU_lab_PR3_QN_na = $data['FU_lab_PR3_QN_na'];
        $this->FU_lab_PR3_QN = ($this->FU_lab_PR3_QN != '1') ? $data['FU_lab_PR3_QN'] : null;

        $this->FU_lab_MPO_QN_na = $data['FU_lab_MPO_QN_na'];
        $this->FU_lab_MPO_QN = ($this->FU_lab_MPO_QN != '1') ? $data['FU_lab_MPO_QN'] : null;

        $this->FU_lab_Cdiff_total = $data['FU_lab_Cdiff_total'];

        $this->FU_lab_Cdiff_toxinA = $data['FU_lab_Cdiff_toxinA'];
        $this->FU_lab_Cdiff_toxinA_QN_na = $data['FU_lab_Cdiff_toxinA_QN_na'];
        $this->FU_lab_Cdiff_toxinA_QN = ($this->FU_lab_Cdiff_toxinA_QN != '1') ? $data['FU_lab_Cdiff_toxinA_QN'] : null;

        $this->FU_lab_Cdiff_toxinB = $data['FU_lab_Cdiff_toxinB'];
        $this->FU_lab_Cdiff_toxinB_QN_na = $data['FU_lab_Cdiff_toxinB_QN_na'];
        $this->FU_lab_Cdiff_toxinB_QN = ($this->FU_lab_Cdiff_toxinB_QN != '1') ? $data['FU_lab_Cdiff_toxinB_QN'] : null;

        $this->FU_lab_Cdiff_PCR = $data['FU_lab_Cdiff_PCR'];

        $this->FU_bio = $data['FU_bio'];
        $this->FU_bio_cat = ($this->FU_bio == '1') ? $data['FU_bio_cat'] : null;

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $this->is_WBC_na = ($this->FU_lab_WBC_na == '1'); // WBC - N/A (획득되지 않음)
        $this->is_Hb_na = ($this->FU_lab_Hb_na == '1'); // Hemoglobin - N/A (획득되지 않음)
        $this->is_ESR_na = ($this->FU_lab_ESR_na == '1'); // ESR - N/A (획득되지 않음)
        $this->is_CRP_na = ($this->FU_lab_CRP_na == '1'); // CRP - N/A (획득되지 않음)
        $this->is_alb_na = ($this->FU_lab_alb_na == '1'); // Albumin - N/A (획득되지 않음)
        $this->is_FC_na = ($this->FU_lab_FC_na == '1'); // Fecal Calprotectin - N/A (획득되지 않음)
        $this->is_IgG_QN_na = ($this->FU_lab_IgG_QN_na == '1'); // ASCA IgG 정량 - N/A (획득되지 않음)
        $this->is_IgA_QN_na = ($this->FU_lab_IgA_QN_na == '1'); // ASCA IgA 정량 - N/A (획득되지 않음)
        $this->is_ANCA_total_na = ($this->FU_lab_ANCA_total_na == '1'); // ANCA (titer, total) - N/A (획득되지 않음)
        $this->is_PR3_QN_na = ($this->FU_lab_PR3_QN_na == '1'); // ANCA (PR3, 정량) - N/A (획득되지 않음)
        $this->is_MPO_QN_na = ($this->FU_lab_MPO_QN_na == '1'); // ANCA (MPO, 정량) - N/A (획득되지 않음)
        $this->is_Cdiff_toxinA_QN_na = ($this->FU_lab_Cdiff_toxinA_QN_na == '1'); // C.difficile toxin A quant - N/A (획득되지 않음)
        $this->is_Cdiff_toxinB_QN_na = ($this->FU_lab_Cdiff_toxinB_QN_na == '1'); // C.difficile toxin B quant - N/A (획득되지 않음)
        $this->is_bio_y = ($this->FU_bio == '1'); // 대변검체획득 시점 Biologics 사용 여부 - 예

        return $this;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'regist_num', 'regist_num')->withTrashed();
    }

    public function Fu()
    {
        return $this->belongsTo(Fu::class, 'FU_sid')->withTrashed();
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
