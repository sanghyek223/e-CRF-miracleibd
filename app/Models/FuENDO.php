<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FuENDO extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'FU_endo_tbl';

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

        static::saving(function ($FuENDO) {
            if (!isAdmin()) {
                // 마지막 수정자
                $FuENDO->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($FuENDO) {
            $Fu = $FuENDO->Fu;

            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $Fu->update([
                'status_FU_endo' => $FuENDO->status,
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

    public function getExcelField()
    {
        $except = ['sid', 'last_reg_id', 'regist_num', 'FU_sid', 'status', 'created_at', 'updated_at', 'deleted_at'];
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable());

        return array_values(array_diff($columns, $except));
    }

    public function setByData($data)
    {
        $fuConfig = $this->fuConfig();
        $endoConfig = $fuConfig['ENDO'];

        // 내시경 검사일
        $FU_endo_d = "{$data['FU_endo_d_y']}-{$data['FU_endo_d_m']}-{$data['FU_endo_d_d']}";
        $FU_endo_d_replace = str_replace('-', '', $FU_endo_d);

        if (empty($FU_endo_d_replace)) {
            $FU_endo_d = '';
        }

        $this->FU_endo_d = $FU_endo_d;
        $this->FU_endo_sev = $data['FU_endo_sev'];

        // 소장내시경 검사일
        $FU_entero_d = "{$data['FU_entero_d_y']}-{$data['FU_entero_d_m']}-{$data['FU_entero_d_d']}";
        $FU_entero_d_replace = str_replace('-', '', $FU_entero_d);

        if (empty($FU_entero_d_replace)) {
            $FU_entero_d = '';
        }

        $this->FU_entero_d = $FU_entero_d;
        $this->FU_entero_sev = $data['FU_entero_sev'];

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $FU_endo_d = empty($this->FU_endo_d) ? '' : explode('-', $this->FU_endo_d);

        $this->FU_endo_d_y = $FU_endo_d[0] ?? '';
        $this->FU_endo_d_m = $FU_endo_d[1] ?? '';
        $this->FU_endo_d_d = $FU_endo_d[2] ?? '';

        $FU_entero_d = empty($this->FU_entero_d) ? '' : explode('-', $this->FU_entero_d);

        $this->FU_entero_d_y = $FU_entero_d[0] ?? '';
        $this->FU_entero_d_m = $FU_entero_d[1] ?? '';
        $this->FU_entero_d_d = $FU_entero_d[2] ?? '';

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
