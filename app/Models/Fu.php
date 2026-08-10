<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Fu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'FU_tbl';

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

        static::created(function ($Fu) {

            foreach ($Fu->allData() as $key => $model) {
                $model->insert([
                    'regist_num' => $Fu->regist_num,
                    'FU_sid' => $Fu->sid,
                ]);
            }

        });

        // 삭제시
        static::deleting(function ($Fu) {

            // 연관 데이터 전체 삭제
            foreach ($Fu->allData() as $tab => $model) {
                $model->delete();
            }
        });

        // 복원시
        static::restoring(function ($Fu) {

            // 연관 데이터 전체 복원
            foreach ($Fu->allData() as $tab => $model) {
                $model->restore();
            }
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
        $FU_visit_d = "{$data['FU_visit_d_y']}-{$data['FU_visit_d_m']}-{$data['FU_visit_d_d']}";

        $this->FU_visit_d = $FU_visit_d;
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $FU_visit_d = empty($this->FU_visit_d) ? '' : explode('-', $this->FU_visit_d);

        $this->FU_visit_d_y = $FU_visit_d[0] ?? '';
        $this->FU_visit_d_m = $FU_visit_d[1] ?? '';
        $this->FU_visit_d_d = $FU_visit_d[2] ?? '';

        return $this;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'regist_num', 'regist_num')->withTrashed();
    }

    public function FuBX()
    {
        return $this->hasOne(FuBX::class, 'FU_sid')->withTrashed();
    }

    public function FuLAB()
    {
        return $this->hasOne(FuLAB::class, 'FU_sid')->withTrashed();
    }

    public function FuENDO()
    {
        return $this->hasOne(FuENDO::class, 'FU_sid')->withTrashed();
    }

    public function FuIMG()
    {
        return $this->hasOne(FuIMG::class, 'FU_sid')->withTrashed();
    }

    public function allData($getTarget = [])
    {
        return [
            'BX' => $this->FuBX ?? (new FuBX()),
            'LAB' => $this->FuLAB ?? (new FuLAB()),
            'ENDO' => $this->FuENDO ?? (new FuENDO()),
            'IMG' => $this->FuIMG ?? (new FuIMG()),
        ];
    }

    public function updateStatusBASE()
    {
        $status = 'C';
        $allBaseData = $this->allData(['BASE']);

        foreach ($allBaseData['BASE'] as $key => $rowData) {
            if ($rowData->status !== 'C') {
                $status = 'I';
                break;
            }
        }

        // Baseline 전체 입력 상태값 업데이트
        $this->status_Base = $status;
        $this->saveQuietly();
    }

    public function getRegStatus($tab)
    {
        switch ($tab) {
            case 'BX':
                return $this->status_FU_Bx ?? 'N';

            case 'ENDO':
                return $this->status_FU_endo ?? 'N';

            case 'IMG':
                return $this->status_FU_img ?? 'N';

            case 'LAB':
                return $this->status_FU_lab ?? 'N';

            default:
                return '';
        }
    }

    public function getRegStatusName($tab)
    {
        $status = $this->getRegStatus($tab);
        return $this->registerConfig()['status'][$status]['name'] ?? '';
    }

    public function getRegStatusClass($tab)
    {
        $status = $this->getRegStatus($tab);
        return $this->registerConfig()['status'][$status]['class'] ?? '';
    }
}
