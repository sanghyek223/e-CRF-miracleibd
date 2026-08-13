<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FuIMG extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'FU_img_tbl';

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

        static::saving(function ($FuIMG) {
            if (!isAdmin()) {
                // 마지막 수정자
                $FuIMG->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($FuIMG) {
            $Fu = $FuIMG->Fu;

            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $Fu->update([
                'status_FU_img' => $FuIMG->status,
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
        $imgConfig = $fuConfig['IMG'];

        // 내시경 검사일
        $FU_img_d = "{$data['FU_img_d_y']}-{$data['FU_img_d_m']}-{$data['FU_img_d_d']}";
        $FU_img_d_replace = str_replace('-', '', $FU_img_d);

        if (empty($FU_img_d_replace)) {
            $FU_img_d = '';
        }

        $this->FU_img_d = $FU_img_d;

        $this->FU_img_sev = $data['FU_img_sev'];

        $this->FU_inv_seg1 = $data['FU_inv_seg1'];
        $this->FU_inv_seg2 = $data['FU_inv_seg2'];
        $this->FU_inv_seg3 = $data['FU_inv_seg3'];
        $this->FU_inv_seg4 = $data['FU_inv_seg4'];
        $this->FU_inv_seg5 = $data['FU_inv_seg5'];
        $this->FU_inv_seg6 = $data['FU_inv_seg6'];
        $this->FU_inv_seg7 = $data['FU_inv_seg7'];
        $this->FU_inv_seg8 = $data['FU_inv_seg8'];
        $this->FU_inv_seg9 = $data['FU_inv_seg9'];

        $this->FU_fistula = $data['FU_fistula'];
        $this->FU_stricture = $data['FU_stricture'];
        $this->FU_abscess = $data['FU_abscess'];

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $FU_img_d = empty($this->FU_img_d) ? '' : explode('-', $this->FU_img_d);

        $this->FU_img_d_y = $FU_img_d[0] ?? '';
        $this->FU_img_d_m = $FU_img_d[1] ?? '';
        $this->FU_img_d_d = $FU_img_d[2] ?? '';

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
