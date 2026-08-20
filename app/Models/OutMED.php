<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OutMED extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Out_med_tbl';

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

        static::saving(function ($OutMED) {
            if (!isAdmin()) {
                // 마지막 수정자
                $OutMED->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($OutMED) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $OutMED->patient->updateStatusOUT();
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
        $medConfig = $outConfig['MED'];

        // 추가 투약 - 생물학적제제 – 1차
        $out_bio1_d = "{$data['out_bio1_d_y']}-{$data['out_bio1_d_m']}-{$data['out_bio1_d_d']}";
        $out_bio1_d_replace = str_replace('-', '', $out_bio1_d);

        if (empty($out_bio1_d_replace)) {
            $out_bio1_d = '';
        }

        $this->out_bio1 = $data['out_bio1'];
        $is_bio1_y = ($this->out_bio1 == '1');

        $this->out_bio1_d = ($is_bio1_y) ? $out_bio1_d : null;
        $this->out_bio1_cat = ($is_bio1_y) ? $data['out_bio1_cat'] : null;

        // 추가 투약 - 생물학적제제 – 2차
        $out_bio2_d = "{$data['out_bio2_d_y']}-{$data['out_bio2_d_m']}-{$data['out_bio2_d_d']}";
        $out_bio2_d_replace = str_replace('-', '', $out_bio2_d);

        if (empty($out_bio2_d_replace)) {
            $out_bio2_d = '';
        }

        $this->out_bio2 = $data['out_bio2'];
        $is_bio2_y = ($this->out_bio2 == '1');

        $this->out_bio2_d = ($is_bio2_y) ? $out_bio2_d : null;
        $this->out_bio2_cat = ($is_bio2_y) ? $data['out_bio2_cat'] : null;

        // 추가 투약 - 생물학적제제 – 3차
        $out_bio3_d = "{$data['out_bio3_d_y']}-{$data['out_bio3_d_m']}-{$data['out_bio3_d_d']}";
        $out_bio3_d_replace = str_replace('-', '', $out_bio3_d);

        if (empty($out_bio3_d_replace)) {
            $out_bio3_d = '';
        }

        $this->out_bio3 = $data['out_bio3'];
        $is_bio3_y = ($this->out_bio3 == '1');

        $this->out_bio3_d = ($is_bio3_y) ? $out_bio3_d : null;
        $this->out_bio3_cat = ($is_bio3_y) ? $data['out_bio3_cat'] : null;

        // 추가 투약 - 생물학적제제 – 4차
        $out_bio4_d = "{$data['out_bio4_d_y']}-{$data['out_bio4_d_m']}-{$data['out_bio4_d_d']}";
        $out_bio4_d_replace = str_replace('-', '', $out_bio4_d);

        if (empty($out_bio4_d_replace)) {
            $out_bio4_d = '';
        }

        $this->out_bio4 = $data['out_bio4'];
        $is_bio4_y = ($this->out_bio4 == '1');

        $this->out_bio4_d = ($is_bio4_y) ? $out_bio4_d : null;
        $this->out_bio4_cat = ($is_bio4_y) ? $data['out_bio4_cat'] : null;

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $this->is_bio1_y = ($this->out_bio1 == '1'); // 설문 진행 유무 1차 - 예
        $out_bio1_d = empty($this->out_bio1_d) ? '' : explode('-', $this->out_bio1_d);

        $this->out_bio1_d_y = $out_bio1_d[0] ?? '';
        $this->out_bio1_d_m = $out_bio1_d[1] ?? '';
        $this->out_bio1_d_d = $out_bio1_d[2] ?? '';

        $this->is_bio2_y = ($this->out_bio2 == '1'); // 설문 진행 유무 2차 - 예
        $out_bio2_d = empty($this->out_bio2_d) ? '' : explode('-', $this->out_bio2_d);

        $this->out_bio2_d_y = $out_bio2_d[0] ?? '';
        $this->out_bio2_d_m = $out_bio2_d[1] ?? '';
        $this->out_bio2_d_d = $out_bio2_d[2] ?? '';

        $this->is_bio3_y = ($this->out_bio3 == '1'); // 설문 진행 유무 3차 - 예
        $out_bio3_d = empty($this->out_bio3_d) ? '' : explode('-', $this->out_bio3_d);

        $this->out_bio3_d_y = $out_bio3_d[0] ?? '';
        $this->out_bio3_d_m = $out_bio3_d[1] ?? '';
        $this->out_bio3_d_d = $out_bio3_d[2] ?? '';

        $this->is_bio4_y = ($this->out_bio4 == '1'); // 설문 진행 유무 4차 - 예
        $out_bio4_d = empty($this->out_bio4_d) ? '' : explode('-', $this->out_bio4_d);

        $this->out_bio4_d_y = $out_bio4_d[0] ?? '';
        $this->out_bio4_d_m = $out_bio4_d[1] ?? '';
        $this->out_bio4_d_d = $out_bio4_d[2] ?? '';

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
