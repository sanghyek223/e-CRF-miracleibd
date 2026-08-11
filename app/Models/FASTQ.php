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

        foreach ($uploadConfig['file'] as $key => $val) {
            $file = $data->file($key) ?? null; // 첨부파일
            $fileDel = $data->{$key . '_del'} ?? ''; // 파일삭제

            $fileSize = $uploadConfig['file'][$key]['file_size']; // 파일 사이즈
            $originName = $uploadConfig['file'][$key]['origin_name']; // 원본 파일명
            $uploadName = $uploadConfig['file'][$key]['upload_name']; // 업로드 파일명

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

        $file1 = $this->FASTQ_f1_name_real;
        $file2 = $this->FASTQ_f2_name_real;

        // 입력상태
        $this->status = match (true) {
            empty($file1) && empty($file2) => 'N',
            empty($file1) || empty($file2) => 'I',
            default => 'C',
        };
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
        $uploadName = $this->{$uploadConfig['file'][$field]['upload_name']};

        return "/storage/uploads/{$uploadConfig['directory']}/$uploadName";
    }

    public function scopeHasFile($query)
    {
        return $query->where(function ($sub) {
            $sub->whereNotNull('FASTQ_f1_name_real')->where('FASTQ_f1_name_real', '!=', '');
        })->orWhere(function ($sub) {
            $sub->whereNotNull('FASTQ_f2_name_real')->where('FASTQ_f2_name_real', '!=', '');
        });
    }

    public function getFileNameAll()
    {
        $fastqConfig = $this->fastqConfig();
        $uploadConfig = $fastqConfig['UPLOAD'];

        foreach ($uploadConfig['file'] as $key => $val) {
            if (!empty($this->{$val['upload_name']})) {
                $file_names[] = $this->{$val['upload_name']};
            }
        }

        return $file_names ?? [];
    }

    public function getFileSizeAll()
    {
        $fastqConfig = $this->fastqConfig();
        $uploadConfig = $fastqConfig['UPLOAD'];

        $file_size = 0;

        foreach ($uploadConfig['file'] as $key => $val) {
            $file_size += (int)$this->{$val['file_size']} ?? 0;
        }

        return $file_size;
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
