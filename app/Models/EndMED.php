<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EndMED extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'End_med_tbl';

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

        static::saving(function ($EndMED) {
            if (!isAdmin()) {
                // 마지막 수정자
                $EndMED->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($EndMED) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $EndMED->patient->updateStatusEND();
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
        $medConfig = $endConfig['MED'];

        $this->end_med = $data['end_med'];

        $this->end_5ASA = $data['end_5ASA'] ?? null;
        $this->end_aza = $data['end_aza'] ?? null;
        $this->end_MTX = $data['end_MTX'] ?? null;
        $this->end_tofa = $data['end_tofa'] ?? null;
        $this->end_oza = $data['end_oza'] ?? null;
        $this->end_st = $data['end_st'] ?? null;

        $this->end_bio = $data['end_bio'];
        $this->end_bio_cat = $data['end_bio_cat'] ?? null;

        $end_out_v_d = "{$data['end_out_v_d_y']}-{$data['end_out_v_d_m']}-{$data['end_out_v_d_d']}"; // 설문지 작성일자
        $end_out_v_d_replace = str_replace('-', '', $end_out_v_d);

        if (empty($end_out_v_d_replace)) {
            $end_out_v_d = '';
        }

        $this->end_out_v_d = $end_out_v_d;

        $this->end_ER_adm_v = $data['end_ER_adm_v'];

        $end_ER_adm_d = "{$data['end_ER_adm_d_y']}-{$data['end_ER_adm_d_m']}-{$data['end_ER_adm_d_d']}"; // 설문지 작성일자
        $end_ER_adm_d_replace = str_replace('-', '', $end_ER_adm_d);

        if (empty($end_ER_adm_d_replace)) {
            $end_ER_adm_d = '';
        }

        $this->end_ER_adm_d = $end_ER_adm_d;

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $this->is_med_y = ($this->end_med == '1'); // 약물 투약 여부 - 예

        $end_out_v_d = empty($this->end_out_v_d) ? '' : explode('-', $this->end_out_v_d);

        $this->end_out_v_d_y = $end_out_v_d[0] ?? '';
        $this->end_out_v_d_m = $end_out_v_d[1] ?? '';
        $this->end_out_v_d_d = $end_out_v_d[2] ?? '';

        $this->is_bio_y = ($this->end_bio == '1'); // 생물학제제 투약 여부 - 예
        $this->is_ER_adm_v_y = ($this->end_ER_adm_v == '1'); // 입원 또는 응급실 방문 - 예

        $end_ER_adm_d = empty($this->end_ER_adm_d) ? '' : explode('-', $this->end_ER_adm_d);

        $this->end_ER_adm_d_y = $end_ER_adm_d[0] ?? '';
        $this->end_ER_adm_d_m = $end_ER_adm_d[1] ?? '';
        $this->end_ER_adm_d_d = $end_ER_adm_d[2] ?? '';

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
