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

    public function FASTQZipDownload($jobId)
    {
        $progress = Cache::get("zip_progress_{$jobId}");

        abort_unless($progress && $progress['status'] === 'done', 404);
        abort_unless(File::exists($progress['real_path']), 404);

        return response()->download($progress['real_path'])->deleteFileAfterCallback();
    }

    public function captchaMake(Request $request)
    {
        return $this->CommonServices->captchaMakeService();
    }
}