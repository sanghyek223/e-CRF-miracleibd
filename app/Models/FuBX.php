<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FuBX extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'FU_Bx_tbl';

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

        static::saving(function ($FuBX) {
            if (!isAdmin()) {
                // 마지막 수정자
                $FuBX->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($FuBX) {
            $Fu = $FuBX->Fu;

            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $Fu->update([
                'status_FU_Bx' => $FuBX->status,
            ]);

            // FU_feces_dt가 실제 변경된 경우에만 업데이트
            if (!empty($FuBX->FU_feces_dt) && $FuBX->wasChanged('FU_feces_dt')) {
                $Fu->FuLAB->update([
                    'FU_feces_dt' => $FuBX->FU_feces_dt, // 대변 검체 획득일 (자동연동)
                ]);
            }

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
        $bxConfig = $fuConfig['BX'];
        $BaseDX = $this->patient->BaseDX->additionalData(); // 진단 시점 정보

        $is_uc = $BaseDX->is_uc; // IBD Type UC
        $is_cd = $BaseDX->is_cd; // IBD Type CD

        // 대변 검체 획득일
        $FU_feces_dt = "{$data['FU_feces_d_y']}-{$data['FU_feces_d_m']}-{$data['FU_feces_d_d']}";
        $FU_feces_dt_replace = str_replace('-', '', $FU_feces_dt);

        if (empty($FU_feces_dt_replace)) {
            $FU_feces_dt = '';
        }

        $this->FU_feces_dt = $FU_feces_dt;

        // 혈액 검체 획득일
        $FU_bl_dt = "{$data['FU_bl_d_y']}-{$data['FU_bl_d_m']}-{$data['FU_bl_d_d']}";
        $FU_bl_dt_replace = str_replace('-', '', $FU_bl_dt);

        if (empty($FU_bl_dt_replace)) {
            $FU_bl_dt = '';
        }

        $this->FU_bl_dt = $FU_bl_dt;

        // 조직 검체 획득일
        $FU_Bx_dt = "{$data['FU_Bx_d_y']}-{$data['FU_Bx_d_m']}-{$data['FU_Bx_d_d']}";
        $FU_Bx_dt_replace = str_replace('-', '', $FU_Bx_dt);

        if (empty($FU_Bx_dt_replace)) {
            $FU_Bx_dt = '';
        }

        $this->FU_Bx_dt = $FU_Bx_dt;

        $this->FU_acq_norm_cnt = $data['FU_acq_norm_cnt'];
        $this->FU_acq_lesn_cnt = $data['FU_acq_lesn_cnt'];

        $this->FU_req_norm_cnt = $data['FU_req_norm_cnt'];
        $this->FU_req_lesn_cnt = $data['FU_req_lesn_cnt'];

        $this->FU_Bx_Rectum = $data['FU_Bx_Rectum'];
        $this->FU_Bx_Scolon = $data['FU_Bx_Scolon'];
        $this->FU_Bx_Dcolon = $data['FU_Bx_Dcolon'];
        $this->FU_Bx_Tcolon = $data['FU_Bx_Tcolon'];
        $this->FU_Bx_Acolon = $data['FU_Bx_Acolon'];
        $this->FU_Bx_cecum = $data['FU_Bx_cecum'];
        $this->FU_Bx_Terminal = $data['FU_Bx_Terminal'];

        $is_Rectum = ($this->FU_Bx_Rectum == '1'); // 조직 채취 부위 - Rectum
        $is_Scolon = ($this->FU_Bx_Scolon == '1'); // 조직 채취 부위 - S colon
        $is_Dcolon = ($this->FU_Bx_Dcolon == '1'); // 조직 채취 부위 - D colon
        $is_Tcolon = ($this->FU_Bx_Tcolon == '1'); // 조직 채취 부위 - T colon
        $is_Acolon = ($this->FU_Bx_Acolon == '1'); // 조직 채취 부위 - A colon
        $is_cecum = ($this->FU_Bx_cecum == '1'); // 조직 채취 부위 - Cecum
        $is_Terminal = ($this->FU_Bx_Terminal == '1'); // 조직 채취 부위 - Terminal ileum

        $this->FU_Bx_rec = $is_Rectum ? $data['FU_Bx_rec'] : null;
        $this->FU_Bx_rec_r1 = $is_Rectum ? $data['FU_Bx_rec_r1'] : null;
        $this->FU_Bx_rec_r2 = $is_Rectum ? $data['FU_Bx_rec_r2'] : null;
        $this->FU_Bx_rec_r3 = $is_Rectum ? $data['FU_Bx_rec_r3'] : null;
        $this->FU_Bx_rec_r4 = $is_Rectum ? $data['FU_Bx_rec_r4'] : null;

        $this->FU_Bx_SC = $is_Scolon ? $data['FU_Bx_SC'] : null;
        $this->FU_Bx_SC_r1 = $is_Scolon ? $data['FU_Bx_SC_r1'] : null;
        $this->FU_Bx_SC_r2 = $is_Scolon ? $data['FU_Bx_SC_r2'] : null;
        $this->FU_Bx_SC_r3 = $is_Scolon ? $data['FU_Bx_SC_r3'] : null;
        $this->FU_Bx_SC_r4 = $is_Scolon ? $data['FU_Bx_SC_r4'] : null;

        $this->FU_Bx_DC = $is_Dcolon ? $data['FU_Bx_DC'] : null;
        $this->FU_Bx_DC_r1 = $is_Dcolon ? $data['FU_Bx_DC_r1'] : null;
        $this->FU_Bx_DC_r2 = $is_Dcolon ? $data['FU_Bx_DC_r2'] : null;
        $this->FU_Bx_DC_r3 = $is_Dcolon ? $data['FU_Bx_DC_r3'] : null;
        $this->FU_Bx_DC_r4 = $is_Dcolon ? $data['FU_Bx_DC_r4'] : null;

        $this->FU_Bx_TC = $is_Tcolon ? $data['FU_Bx_TC'] : null;
        $this->FU_Bx_TC_r1 = $is_Tcolon ? $data['FU_Bx_TC_r1'] : null;
        $this->FU_Bx_TC_r2 = $is_Tcolon ? $data['FU_Bx_TC_r2'] : null;
        $this->FU_Bx_TC_r3 = $is_Tcolon ? $data['FU_Bx_TC_r3'] : null;
        $this->FU_Bx_TC_r4 = $is_Tcolon ? $data['FU_Bx_TC_r4'] : null;

        $this->FU_Bx_AC = $is_Acolon ? $data['FU_Bx_AC'] : null;
        $this->FU_Bx_AC_r1 = $is_Acolon ? $data['FU_Bx_AC_r1'] : null;
        $this->FU_Bx_AC_r2 = $is_Acolon ? $data['FU_Bx_AC_r2'] : null;
        $this->FU_Bx_AC_r3 = $is_Acolon ? $data['FU_Bx_AC_r3'] : null;
        $this->FU_Bx_AC_r4 = $is_Acolon ? $data['FU_Bx_AC_r4'] : null;

        $this->FU_Bx_cec = $is_cecum ? $data['FU_Bx_cec'] : null;
        $this->FU_Bx_cec_r1 = $is_cecum ? $data['FU_Bx_cec_r1'] : null;
        $this->FU_Bx_cec_r2 = $is_cecum ? $data['FU_Bx_cec_r2'] : null;
        $this->FU_Bx_cec_r3 = $is_cecum ? $data['FU_Bx_cec_r3'] : null;
        $this->FU_Bx_cec_r4 = $is_cecum ? $data['FU_Bx_cec_r4'] : null;

        $this->FU_Bx_TI = $is_Terminal ? $data['FU_Bx_TI'] : null;
        $this->FU_Bx_TI_r1 = $is_Terminal ? $data['FU_Bx_TI_r1'] : null;
        $this->FU_Bx_TI_r2 = $is_Terminal ? $data['FU_Bx_TI_r2'] : null;
        $this->FU_Bx_TI_r3 = $is_Terminal ? $data['FU_Bx_TI_r3'] : null;
        $this->FU_Bx_TI_r4 = $is_Terminal ? $data['FU_Bx_TI_r4'] : null;

        $this->FU_MES = ($is_uc) ? $data['FU_MES'] : null;
        $this->FU_UCEIS = ($is_uc) ? $data['FU_UCEIS'] : null;
        $this->FU_SES_CD = ($is_cd) ? $data['FU_SES_CD'] : null;

        // 입력상태
        if (!$is_uc && !$is_cd) {
            // IBD Type 이 선택 안되어있으면 무조건 I
            $this->status = 'I';
        } else {
            $this->status = empty($data['status']) ? 'I' : 'C';
        }
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $BaseDX = $this->patient->BaseDX->additionalData(); // 진단 시점 정보

        $this->is_uc = $BaseDX->is_uc; // IBD Type UC
        $this->is_cd = $BaseDX->is_cd; // IBD Type CD

        $FU_feces_dt = empty($this->FU_feces_dt) ? '' : explode('-', $this->FU_feces_dt);

        $this->FU_feces_d_y = $FU_feces_dt[0] ?? '';
        $this->FU_feces_d_m = $FU_feces_dt[1] ?? '';
        $this->FU_feces_d_d = $FU_feces_dt[2] ?? '';

        $FU_bl_dt = empty($this->FU_bl_dt) ? '' : explode('-', $this->FU_bl_dt);

        $this->FU_bl_d_y = $FU_bl_dt[0] ?? '';
        $this->FU_bl_d_m = $FU_bl_dt[1] ?? '';
        $this->FU_bl_d_d = $FU_bl_dt[2] ?? '';

        $FU_Bx_dt = empty($this->FU_Bx_dt) ? '' : explode('-', $this->FU_Bx_dt);

        $this->FU_Bx_d_y = $FU_Bx_dt[0] ?? '';
        $this->FU_Bx_d_m = $FU_Bx_dt[1] ?? '';
        $this->FU_Bx_d_d = $FU_Bx_dt[2] ?? '';

        $this->is_Rectum = ($this->FU_Bx_Rectum == '1'); // 조직 채취 부위 - Rectum
        $this->is_Scolon = ($this->FU_Bx_Scolon == '1'); // 조직 채취 부위 - S colon
        $this->is_Dcolon = ($this->FU_Bx_Dcolon == '1'); // 조직 채취 부위 - D colon
        $this->is_Tcolon = ($this->FU_Bx_Tcolon == '1'); // 조직 채취 부위 - T colon
        $this->is_Acolon = ($this->FU_Bx_Acolon == '1'); // 조직 채취 부위 - A colon
        $this->is_cecum = ($this->FU_Bx_cecum == '1'); // 조직 채취 부위 - Cecum
        $this->is_Terminal = ($this->FU_Bx_Terminal == '1'); // 조직 채취 부위 - Terminal ileum

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
