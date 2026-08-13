<?php

namespace App\Jobs;

use App\Services\CommonServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class FASTQZipDownloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $jobId, protected $patients, protected $filename)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $totalPatients = count($this->patients);
        $processed = 0;

        if ($totalPatients === 0) {
            Cache::put("zip_progress_{$this->jobId}", [
                'status' => 'failed',
                'message' => '다운로드할 항목이 없습니다.',
            ], now()->addHours(1));
            return;
        }

        $uploadConfig = config('site.register.FASTQ.UPLOAD');

        // Zip 파일을 저장할 디렉터리 경로
        $zipDirectory = storage_path('app/zipArchive');

        // 폴더가 없을경우 생성
        if (!File::exists($zipDirectory)) {
            File::makeDirectory($zipDirectory, 0755, true);
        }

        // 특수문자 제거한 압축 파일명
        $zipFile['filename'] = (new CommonServices())->filenameRegx($this->filename);

        // 압축 파일 경로
        $zipFile['realfile'] = "{$zipDirectory}/{$zipFile['filename']}";

        // ZipArchive 인스턴스 생성
        $zip = new \ZipArchive();

        // zip 아카이브 생성
        $open = $zip->open($zipFile['realfile'], \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if ($open !== true) {
            Cache::put("zip_progress_{$this->jobId}", [
                'status' => 'failed',
                'message' => "Zip 파일 생성 실패 (code: {$open})",
            ], now()->addHours(1));
            return;
        }

        foreach ($this->patients as $patient) {
            $FASTQ = $patient->FASTQ;

            // 환자별 디렉토리명
            $dir_name = $patient->regist_num;

            foreach ($uploadConfig['file'] as $key => $val) {

                // upload 파일 있다면
                if (!empty($FASTQ->{$val['upload_name']})) {
                    $path = public_path($FASTQ->getUploadPath($key));

                    // 실경로 파일 한번더 체크 후 추가
                    if (File::exists($path)) {
                        $zip->addFile($path, $dir_name . '/' . $FASTQ->{$val['origin_name']});
                    }
                }
            }

            $processed++;
            $percent = (int) round(($processed / $totalPatients) * 100);

            Cache::put("zip_progress_{$this->jobId}", [
                'status' => 'processing',
                'percent' => $percent,
            ], now()->addHours(1));
        }

        $zip->close();

        Cache::put("zip_progress_{$this->jobId}", [
            'status' => 'done',
            'percent' => 100,
            'download_url' => route('fastq.zip.download', $this->jobId),
        ], now()->addHours(1));
    }
}
