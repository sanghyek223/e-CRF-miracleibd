<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OutV extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Out_v_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected ?array $registerConfig = null;

    protected ?array $outConfig = null;

    protected static function booted()
    {
        parent::boot();

        static::saving(function ($OutV) {
            if (!isAdmin()) {
                // 마지막 수정자
                $OutV->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($OutV) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $OutV->patient->updateStatusOUT();
        });
    }

    private function registerConfig()
    {
        if (is_null($this->registerConfig)) {
            $this->registerConfig = config("site.register");
        }

        return $this->registerConfig;
    }

    private function outConfig()
    {
        if (is_null($this->outConfig)) {
            $this->outConfig = $this->registerConfig()['OUT'];
        }

        return $this->outConfig;
    }

    public function setByData($data)
    {
        $outConfig = $this->outConfig();
        $vConfig = $outConfig['V'];

        $this->out_visit = $data['out_visit'];
        $is_visit_y = ($this->out_visit == '1'); // ER/Admission 데이터 구분용
        $this->out_visit_cnt = ($is_visit_y) ? $data['out_visit_cnt'] : '0';

        // ER/Admission 리스트
        for ($i = 1; $i <= $vConfig['v_list_max']; $i++) {
            $radio_field = "out_visit{$i}_k";
            $text_field = "out_visit{$i}_w";
            $date_field = "out_visit{$i}_d";

            $out_visit_k = $data[$radio_field] ?? '';
            $out_visit_w = $data[$text_field] ?? '';
            $out_visit_d_y = $data["out_visit{$i}_d_y"] ?? '';
            $out_visit_d_m = $data["out_visit{$i}_d_m"] ?? '';
            $out_visit_d_d = $data["out_visit{$i}_d_d"] ?? '';

            $out_visit_d = "{$out_visit_d_y}-{$out_visit_d_m}-{$out_visit_d_d}";
            $out_visit_d_replace = str_replace('-', '', $out_visit_d);

            if (empty($out_visit_d_replace)) {
                $out_visit_d = '';
            }

            $this->{$radio_field} = $is_visit_y ? $out_visit_k : null;
            $this->{$text_field} = $is_visit_y ? $out_visit_w : null;
            $this->{$date_field} = $is_visit_y ? $out_visit_d : null;
        }

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $this->is_visit_y = ($this->out_visit == '1');
        $this->out_visit_cnt = (int)($this->out_visit_cnt ?? 0);

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
