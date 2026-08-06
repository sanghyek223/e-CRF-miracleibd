<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FASTQ extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'FASTQ_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected ?array $registerConfig = null;

    protected ?array $fastqConfig = null;

    protected static function booted()
    {
        parent::boot();

        static::saving(function ($FASTQ) {
            if (!isAdmin()) {
                // 마지막 수정자
                $FASTQ->last_reg_id = thisUser()->uid;
            }
        });

        static::saved(function ($FASTQ) {
            // saving 할때 하면 상태값 업데이트 반영안되서 저장 완료후
            $FASTQ->patient->updateStatusFASTQ();
        });
    }

    private function registerConfig()
    {
        if (is_null($this->registerConfig)) {
            $this->registerConfig = config("site.register");
        }

        return $this->registerConfig;
    }

    private function fastqConfig()
    {
        if (is_null($this->fastqConfig)) {
            $this->fastqConfig = $this->registerConfig()['FASTQ'];
        }

        return $this->fastqConfig;
    }

    public function setByData($data)
    {
        // 입력상태
        $this->status = empty($data['status']) ? 'I' : 'C';
    }

    public function additionalData() // 노출 정보 추가 가공
    {
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
