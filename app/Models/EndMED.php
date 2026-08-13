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
        $this->end_5ASA = $data['end_5ASA'];
        $this->end_aza = $data['end_aza'];
        $this->end_MTX = $data['end_MTX'];
        $this->end_tofa = $data['end_tofa'];
        $this->end_oza = $data['end_oza'];
        $this->end_st = $data['end_st'];

        $this->end_bio = $data['end_bio'];
        $this->end_bio_cat = ($this->end_bio == '1') ? $data['end_bio_cat'] : null;

        $this->end_out_v_year = $data['end_out_v_year'];
        $this->end_out_v_month = $data['end_out_v_month'];

        $this->end_ER_adm_v = $data['end_ER_adm_v'];
        $this->end_ER_adm_year = ($this->end_ER_adm_v == '1') ? $data['end_ER_adm_year'] : null;
        $this->end_ER_adm_month = ($this->end_ER_adm_v == '1') ? $data['end_ER_adm_month'] : null;

        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
        $this->is_bio_y = ($this->end_bio == '1'); // 생물학제제 투약 여부 - 예
        $this->is_ER_adm_v_y = ($this->end_ER_adm_v == '1'); // 입원 또는 응급실 방문 - 예

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
