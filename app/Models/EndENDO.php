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

        $end_endo_d = "{$data['end_endo_d_y']}-{$data['end_endo_d_m']}-{$data['end_endo_d_d']}"; // 설문지 작성일자
        $end_endo_d_replace = str_replace('-', '', $end_endo_d);

        if (empty($end_endo_d_replace)) {
            $end_endo_d = '';
        }

        $this->end_endo_d = $end_endo_d;

        $end_asst_d = "{$data['end_asst_d_y']}-{$data['end_asst_d_m']}-{$data['end_asst_d_d']}"; // 설문지 작성일자
        $end_asst_d_replace = str_replace('-', '', $end_asst_d);

        if (empty($end_asst_d_replace)) {
            $end_asst_d = '';
        }

        $this->end_asst_d = $end_asst_d;

        $this->end_UC_l = $data['end_UC_l'];
        $this->end_UC_sev = $data['end_UC_sev'];

        $this->end_CD_l = $data['end_CD_l'];
        $this->end_CD_L4 = $data['end_CD_L4'];
        $this->end_CD_sev = $data['end_CD_sev'];
        $this->end_CD_behav = $data['end_CD_behav'];
        $this->end_CD_PA_modi = $data['end_CD_PA_modi'];

        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $Fu = $this->patient->FuLIST()->latest('FU_visit_d')->first(); // Follow-up 가장 최근

        if ($Fu) {
            $Fu = $Fu->additionalData(); // 진단 시점 정보
        }

        $end_endo_d = empty($this->end_endo_d) ? '' : explode('-', $this->end_endo_d);

        $this->end_endo_d_y = $end_endo_d[0] ?? '';
        $this->end_endo_d_m = $end_endo_d[1] ?? '';
        $this->end_endo_d_d = $end_endo_d[2] ?? '';

        $end_asst_d = empty($this->end_asst_d) ? '' : explode('-', $this->end_asst_d);

        $this->end_asst_d_y = $end_asst_d[0] ?? '';
        $this->end_asst_d_m = $end_asst_d[1] ?? '';
        $this->end_asst_d_d = $end_asst_d[2] ?? '';

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
