<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EndENDO extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'End_endo_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected ?array $registerConfig = null;

    protected ?array $endConfig = null;

    protected static function booted()
    {
        parent::boot();

        static::saving(function ($EndENDO) {
            if (!isAdmin()) {
                // 마지막 수정자
                $EndENDO->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($EndENDO) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $EndENDO->patient->updateStatusEND();
        });
    }

    private function registerConfig()
    {
        if (is_null($this->registerConfig)) {
            $this->registerConfig = config("site.register");
        }

        return $this->registerConfig;
    }

    private function endConfig()
    {
        if (is_null($this->endConfig)) {
            $this->endConfig = $this->registerConfig()['END'];
        }

        return $this->endConfig;
    }

    public function getExcelField()
    {
        $except = ['sid', 'last_reg_id', 'regist_num', 'status', 'created_at', 'updated_at', 'deleted_at'];
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable());

        return array_values(array_diff($columns, $except));
    }
    
    public function setByData($data)
    {
        $endConfig = $this->endConfig();
        $endoConfig = $endConfig['ENDO'];
        $BaseDX = $this->patient->BaseDX->additionalData(); // 진단 시점 정보

        $this->end_endo_year = $data['end_endo_year'];
        $this->end_endo_month = $data['end_endo_month'];

        $this->end_asst_year = $data['end_asst_year'];
        $this->end_asst_month = $data['end_asst_month'];

        $this->end_UC_l = ($BaseDX->is_uc ? $data['end_UC_l'] : null);
        $this->end_UC_sens = ($BaseDX->is_uc ? $data['end_UC_sens'] : null);

        $this->end_CD_l = ($BaseDX->is_cd ? $data['end_CD_l'] : null);
        $this->end_CD_L4 = ($BaseDX->is_cd ? $data['end_CD_L4'] : null);
        $this->end_CD_sens = ($BaseDX->is_cd ? $data['end_CD_sens'] : null);
        $this->end_CD_behav = ($BaseDX->is_cd ? $data['end_CD_behav'] : null);
        $this->end_CD_PA_modi = ($BaseDX->is_cd ? $data['end_CD_PA_modi'] : null);

        // 입력상태
        if (!$BaseDX->is_uc && !$BaseDX->is_cd) {
            // IBD Type 이 선택 안되어있으면 무조건 I
            $this->status = 'I';
        } else {
            $this->status = empty($data['status']) ? 'I' : 'C';
        }
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $Fu = $this->patient->FuLIST()->latest('FU_visit_d')->first(); // Follow-up 가장 최근

        if ($Fu) {
            $Fu = $Fu->additionalData(); // 진단 시점 정보
        }

        $this->is_uc = empty($Fu->is_uc) ? false : $Fu->is_uc; // IBD Type UC
        $this->is_cd = empty($Fu->is_cd) ? false : $Fu->is_cd; // IBD Type CD

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
