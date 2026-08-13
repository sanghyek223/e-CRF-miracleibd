<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    private $mypageServices;

    public function __construct()
    {
        $this->mypageServices = (new \App\Services\Mypage\MypageServices());

        view()->share([
            'main_key' => 'MYPAGE',
            
            'userConfig' => getConfig('user'),

            'dataConfig' => config('site.data'),
            'patientConfig' => config('site.patient'),
            'registerConfig' => config('site.register'),
        ]);
    }

    public function application(Request $request)
    {
        view()->share(['sub_key' => 'S1']);
        return view('mypage.application.index', $this->mypageServices->applicationService($request));
    }

    public function applicationDownload(Request $request)
    {
        view()->share(['sub_key' => 'S1']);
        return view('mypage.application.download', $this->mypageServices->applicationDownloadService($request));
    }

    public function applicationDownloadFASTQ(Request $request)
    {
        $request->merge(['FASTQ_download' => true]);
        return $this->mypageServices->applicationDownloadService($request);
    }

    public function applicationDownloadExcel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->mypageServices->applicationDownloadService($request);
    }

    public function approval(Request $request)
    {
        view()->share(['sub_key' => 'S2']);
        return view('mypage.approval.index', $this->mypageServices->approvalService($request));
    }

    public function approvalDetail(Request $request)
    {
        view()->share(['sub_key' => 'S2']);
        return view('mypage.approval.detail', $this->mypageServices->approvalDetailService($request));
    }

    public function personal(Request $request)
    {
        view()->share(['sub_key' => 'S3']);
        return view('mypage.personal', $this->mypageServices->personalService($request));
    }

    public function data(Request $request)
    {
        return $this->mypageServices->dataAction($request);
    }
}
