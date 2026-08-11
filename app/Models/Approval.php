<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'sid';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected ?array $dataConfig = null;

    protected static function booted()
    {
        parent::boot();
    }

    private function dataConfig()
    {
        if (is_null($this->dataConfig)) {
            $this->dataConfig = config("site.data");
        }

        return $this->dataConfig;
    }

    public function setByData($data)
    {
        $dataConfig = $this->dataConfig();
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'org_code', 'org_code');
    }

    public function application() // 타 기관 데이터 열람 신청 내역 상세
    {
        return $this->hasMany(Application::class, 'a_sid');
    }

    public function getConfirm()
    {
        return $this->dataConfig()['confirm'][$this->confirm ?? ''] ?? '';
    }
}
