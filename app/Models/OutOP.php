<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OutOP extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Out_OP_tbl';

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

        static::saving(function ($OutOP) {
            if (!isAdmin()) {
                // 마지막 수정자
                $OutOP->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($OutOP) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $OutOP->patient->updateStatusOUT();
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

    public function getExcelField()
    {
        $except = ['sid', 'last_reg_id', 'regist_num', 'status', 'created_at', 'updated_at', 'deleted_at'];
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing($this->getTable());

        return array_values(array_diff($columns, $except));
    }

    public function setByData($data)
    {
        $outConfig = $this->outConfig();
        $opConfig = $outConfig['OP'];

        $this->out_OP = $data['out_OP'];
        $is_OP_y = ($this->out_OP == '1'); // 수술력 데이터 구분용
        $this->out_OP_cnt = ($is_OP_y) ? $data['out_OP_cnt'] : '0';

        // 수술 리스트
        for ($i = 1; $i <= $opConfig['op_list_max']; $i++) {
            $text_field = "out_OP{$i}";
            $date_field = "out_OP{$i}_dt";

            $out_OP = $data[$text_field] ?? '';
            $out_OP_d_y = $data["out_OP{$i}_d_y"] ?? '';
            $out_OP_d_m = $data["out_OP{$i}_d_m"] ?? '';
            $out_OP_d_d = $data["out_OP{$i}_d_d"] ?? '';

            $out_OP_d = "{$out_OP_d_y}-{$out_OP_d_m}-{$out_OP_d_d}";
            $out_OP_d_replace = str_replace('-', '', $out_OP_d);

            if (empty($out_OP_d_replace)) {
                $out_OP_d = '';
            }

            $this->{$text_field} = $is_OP_y ? $out_OP : null;
            $this->{$date_field} = $is_OP_y ? $out_OP_d : null;
        }

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $this->is_OP_y = ($this->out_OP == '1');
        $this->out_OP_cnt = (int)($this->out_OP_cnt ?? 0);

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
