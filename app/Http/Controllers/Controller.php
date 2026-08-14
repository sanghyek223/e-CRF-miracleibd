<?php

namespace App\Http\Controllers;

use App\Services\CommonServices;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $data = [];

    protected $CommonServices;

    public function __construct()
    {
        $this->CommonServices = (new CommonServices());
    }

    public function tinyUpload(Request $request)
    {
        return [
            'location' => $this->CommonServices->fileUploadService($request->file('file'), '/tinymce')['realfile'],
        ];
    }

    public function plUpload(Request $request)
    {
        return $this->CommonServices->fileUploadService($request->file('file'), $request->directory);
    }

    public function fileDownload(Request $request)
    {
        return ($request->type === 'only')
            ? $this->CommonServices->fileDownloadService($request)
            : $this->CommonServices->zipDownloadService($request);
    }

    public function FASTQDownload(Request $request)
    {
        $job_id = $request->job_id;

        $progress = Cache::get("fastq_progress_{$job_id}");

        // job 이 없거나, 완료 상태가 아니면
        if (!$progress || $progress['status'] !== 'done') {
            return response()->json([
                'success' => false,
                'message' => "다운로드 요청이 만료 되었거나.\n압축이 완료되지 않았습니다.",
            ], 400);
        }

        // 본인 요청 확인
        if ($progress['u_sid'] !== thisPK()) {
            return response()->json([
                'success' => false,
                'message' => '다운로드 권한이 없습니다.',
            ], 403);
        }

        // 실제 파일이 디스크에 존재하는지 재확인
        if (!File::exists($progress['real_path'])) {
            return response()->json([
                'success' => false,
                'message' => '파일을 찾을 수 없습니다.',
            ], 404);
        }

        ini_set('memory_limit', '-1'); // 무제한
        set_time_limit(0); // 실행시간 무제한

        // 전체 다운로드 라면 압축 zip 파일 삭제
        $is_zip = ($progress['download_type'] == 'all');
        
        return response()->download($progress['real_path'], $progress['file_name'])->deleteFileAfterSend($is_zip);
    }

    public function captchaMake(Request $request)
    {
        return $this->CommonServices->captchaMakeService();
    }
}