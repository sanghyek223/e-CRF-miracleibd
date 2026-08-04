<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BaseNTR extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Base_NTR_tbl';

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

        static::saving(function ($BaseNTR) {
            if (checkUrl() !== 'admin') {
                // 마지막 수정자
                $BaseNTR->last_reg_id = thisUser()->uid;
            }

            $patient = $BaseNTR->patient;
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
