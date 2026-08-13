<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BaseIMG extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Base_img_tbl';

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
        
        static::saving(function ($BaseIMG) {
            if (!isAdmin()) {
                // 마지막 수정자
                $BaseIMG->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($BaseIMG) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $BaseIMG->patient->updateStatusBASE();
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
        $imgConfig = $baseConfig['ENDO'];

        $b_img_d = "{$data['b_img_d_y']}-{$data['b_img_d_m']}-{$data['b_img_d_d']}";
        $b_img_d_replace = str_replace('-', '', $b_img_d);

        if (empty($b_img_d_replace)) {
            $b_img_d = '';
        }

        $this->b_img_d_uk = $data['b_img_d_uk'];
        $this->b_img_d = (empty($this->b_img_d_uk) ? $b_img_d : null);

        $this->b_img_sev = $data['b_img_sev'];

        $this->b_inv_seg1 = $data['b_inv_seg1'];
        $this->b_inv_seg2 = $data['b_inv_seg2'];
        $this->b_inv_seg3 = $data['b_inv_seg3'];
        $this->b_inv_seg4 = $data['b_inv_seg4'];
        $this->b_inv_seg5 = $data['b_inv_seg5'];
        $this->b_inv_seg6 = $data['b_inv_seg6'];
        $this->b_inv_seg7 = $data['b_inv_seg7'];
        $this->b_inv_seg8 = $data['b_inv_seg8'];
        $this->b_inv_seg9 = $data['b_inv_seg9'];

        $this->b_fistula = $data['b_fistula'];
        $this->b_stricture = $data['b_stricture'];
        $this->b_abscess = $data['b_abscess'];
        
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $b_img_d = empty($this->b_img_d) ? '' : explode('-', $this->b_img_d);
        $this->is_img_uk = (($this->b_img_d_uk ?? '') == '1'); // 최초 내시경 검사일 Unknown 체크여부

        $this->b_img_d_y = $b_img_d[0] ?? '';
        $this->b_img_d_m = $b_img_d[1] ?? '';
        $this->b_img_d_d = $b_img_d[2] ?? '';

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
