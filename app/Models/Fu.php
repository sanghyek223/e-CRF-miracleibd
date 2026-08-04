<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Fu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'FU_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected ?array $patientConfig = null;

    protected ?array $registerConfig = null;

    protected static function booted()
    {
        parent::boot();

        static::updating(function ($Fu) {
            if (checkUrl() !== 'admin') {
                // 마지막 수정자
                $Fu->last_reg_id = thisUser()->uid;
            }
        });
    }

    private function patientConfig()
    {
        if (is_null($this->patientConfig)) {
            $this->patientConfig = config("site.patient");
        }

        return $this->patientConfig;
    }

    private function registerConfig()
    {
        if (is_null($this->registerConfig)) {
            $this->registerConfig = config("site.register");
        }

        return $this->registerConfig;
    }

    public function setByData($data)
    {

    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'regist_num', 'regist_num')->withTrashed();
    }
}
