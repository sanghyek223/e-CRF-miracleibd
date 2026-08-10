<?php

namespace App\Models;

use App\Services\CommonServices;
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
        $fastqConfig = $this->fastqConfig();
        $uploadConfig = $fastqConfig['UPLOAD'];

        foreach($uploadConfig['file'] as $key => $val) {
            $file = $data->file($key) ?? null; // 첨부파일
            $fileDel = $data->{$key . '_del'} ?? ''; // 파일삭제

            $fileSize = ($key . '_size'); // 파일 사이즈
            $uploadName = ($key . '_name'); // 업로드 파일명
            $originName = ($key . '_name_real'); // 원본 파일명

            // 파일 삭제이면서 기존 첨부파일 있을경우 경로에 있는 실제 파일 삭제
            if (($fileDel == 'Y') && !is_null($this->{$uploadName})) {
//                (new CommonServices())->fileDeleteService($this->getUploadPath($key));

                // 첨부파일이 없다면 기존 파일경로 및 파일명 초기화
                if (is_null($file)) {
                    $this->{$fileSize} = null;
                    $this->{$uploadName} = null;
                    $this->{$originName} = null;
                }
            }

            // 첨부파일 있을경우 업로드후 경로 저장
            if ($file) {
                $directory = $uploadConfig['directory'];
                $uploadFile = (new CommonServices())->fileUploadService2($file, $directory);

                $this->{$fileSize} = $uploadFile['file_size'];
                $this->{$uploadName} = $uploadFile['upload_name'];
                $this->{$originName} = $uploadFile['origin_name'];
            }
        }

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

    public function getUploadPath($field)
    {
        $fastqConfig = $this->fastqConfig();
        $uploadConfig = $fastqConfig['UPLOAD'];
        $uploadFIleName = $this->{$field . '_name'};

        return "/storage/uploads/{$uploadConfig['directory']}/$uploadFIleName";
    }

    public function downloadUrl($fileName) // 첨부 파일 다운로드
    {
        // 관리자 경로로 셋팅될때 있어서 수동으로

        /*
         'type' => 'only',
         'tbl' => 'FASTQ',
         'sid' => enCryptString($this->sid),
        */

        return url('common/fileDownload/only/FASTQ/' . enCryptString($this->sid) . "?field={$fileName}");
    }
}
