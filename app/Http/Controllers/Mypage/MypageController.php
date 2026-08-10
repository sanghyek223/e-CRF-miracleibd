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
            'userConfig' => getConfig('user'),
            'main_key' => 'MYPAGE',
        ]);
    }

    public function application(Request $request)
    {
        view()->share(['sub_key' => 'S1']);
        return view('mypage.application.index', $this->mypageServices->applicationService($request));
    }

    public function approval(Request $request)
    {
        view()->share(['sub_key' => 'S2']);
        return view('mypage.approval.index', $this->mypageServices->approvalService($request));
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
