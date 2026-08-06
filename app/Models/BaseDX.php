<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BaseDX extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Base_Dx_tbl';

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

        static::updated(function ($BaseDX) {
            if ($BaseDX->isDirty('b_BMI')) {
                // b_BMI가 변경된 경우만 실행 (영양 인자 설문 BMI 업데이트)
                $BaseNTR = $BaseDX->patient->BaseNTR;
                $BaseNTR->b_BMI = $BaseDX->b_BMI;
                $BaseNTR->saveQuietly();
            }
        });

        static::saving(function ($BaseDX) {
            if (checkUrl() !== 'admin') {
                // 마지막 수정자
                $BaseDX->last_reg_id = thisUser()->uid;
            }

            $patient = $BaseDX->patient;
            $patient->updateStatusBASE();
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

    public function setByData($data)
    {
        $baseConfig = $this->baseConfig();
        $dxConfig = $baseConfig['DX'];

        $IBD_d = "{$data['IBD_d_y']}-{$data['IBD_d_m']}-{$data['IBD_d_d']}";
        $IBD_d_replace = str_replace('-', '', $IBD_d);

        if (empty($IBD_d_replace)) {
            $IBD_d = '';
        }

        $this->IBD_d = $IBD_d;
        $this->IBD_age = $data['IBD_age'];
        $this->IBD_type = $data['IBD_type'];

        $this->b_HT = $data['b_HT'];
        $this->b_WT = $data['b_WT'];
        $this->b_BMI = $data['b_BMI'];


        // IBD Type 별 데이터 구분용
        $is_uc = ($this->IBD_type == '1');
        $is_cd = ($this->IBD_type == '2');

        $this->b_UC_l = $is_uc ? $data['b_UC_l'] : null;
        $this->b_UC_sens = $is_uc ? $data['b_UC_sens'] : null;

        $this->b_CD_l = $is_cd ? $data['b_CD_l'] : null;
        $this->b_CD_L4 = $is_cd ? $data['b_CD_L4'] : null;
        $this->b_CD_sens = $is_cd ? $data['b_CD_sens'] : null;
        $this->b_CD_PA_modi = $is_cd ? $data['b_CD_PA_modi'] : null;


        $this->b_med = $data['b_med'];
        $is_med = ($this->b_med == '1'); // 약물 투약 여부 데이터 구분용

        $this->b_5ASA = $is_med ? $data['b_5ASA'] : null;
        $this->b_aza = $is_med ? $data['b_aza'] : null;
        $this->b_MTX = $is_med ? $data['b_MTX'] : null;
        $this->b_tofa = $is_med ? $data['b_tofa'] : null;
        $this->b_oza = $is_med ? $data['b_oza'] : null;
        $this->b_st = $is_med ? $data['b_st'] : null;


        $this->b_bio = $is_med ? $data['b_bio'] : null;
        $is_bio = ($this->b_bio == '1'); // 생물학적제제 투약 여부 데이터 구분용

        // 생물학적제제 상세 현황
        for ($i = 1; $i <= $dxConfig['b_bio_max']; $i++) {
            $text_field = "b_bio{$i}_n";
            $date_field = "b_bio{$i}_d";

            $b_bio_n = $data[$text_field] ?? '';
            $b_bio_d_y = $data["b_bio{$i}_d_y"] ?? '';
            $b_bio_d_m = $data["b_bio{$i}_d_m"] ?? '';
            $b_bio_d_d = $data["b_bio{$i}_d_d"] ?? '';

            $b_bio_d = "{$b_bio_d_y}-{$b_bio_d_m}-{$b_bio_d_d}";
            $b_bio_d_replace = str_replace('-', '', $b_bio_d);

            if (empty($b_bio_d_replace)) {
                $b_bio_d = '';
            }

            $this->{$text_field} = $is_bio ? $b_bio_n : null;
            $this->{$date_field} = $is_bio ? $b_bio_d : null;
        }

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $IBD_d = empty($this->IBD_d) ? '' : explode('-', $this->IBD_d);

        $this->IBD_d_y = $IBD_d[0] ?? '';
        $this->IBD_d_m = $IBD_d[1] ?? '';
        $this->IBD_d_d = $IBD_d[2] ?? '';

        $b_bio1_d = empty($this->b_bio1_d) ? '' : explode('-', $this->b_bio1_d);

        $this->b_bio1_d_y = $b_bio1_d[0] ?? '';
        $this->b_bio1_d_m = $b_bio1_d[1] ?? '';
        $this->b_bio1_d_d = $b_bio1_d[2] ?? '';

        $b_bio2_d = empty($this->b_bio2_d) ? '' : explode('-', $this->b_bio2_d);

        $this->b_bio2_d_y = $b_bio2_d[0] ?? '';
        $this->b_bio2_d_m = $b_bio2_d[1] ?? '';
        $this->b_bio2_d_d = $b_bio2_d[2] ?? '';

        $b_bio3_d = empty($this->b_bio3_d) ? '' : explode('-', $this->b_bio3_d);

        $this->b_bio3_d_y = $b_bio3_d[0] ?? '';
        $this->b_bio3_d_m = $b_bio3_d[1] ?? '';
        $this->b_bio3_d_d = $b_bio3_d[2] ?? '';

        $b_bio4_d = empty($this->b_bio4_d) ? '' : explode('-', $this->b_bio4_d);

        $this->b_bio4_d_y = $b_bio4_d[0] ?? '';
        $this->b_bio4_d_m = $b_bio4_d[1] ?? '';
        $this->b_bio4_d_d = $b_bio4_d[2] ?? '';

        $this->is_uc = (($this->IBD_type ?? '') == '1');
        $this->is_cd = (($this->IBD_type ?? '') == '2');
        $this->is_med = (($this->b_med ?? '') == '1');
        $this->is_bio = (($this->b_bio ?? '') == '1' && $this->is_med);

        return $this;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'regist_num', 'regist_num')->withTrashed();
    }

    public function getIBD()
    {
        return $this->baseConfig()['DX']['ibd_type'][$this->IBD_type ?? ''] ?? '';
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
