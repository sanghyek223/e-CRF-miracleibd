<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $memberServices;

    public function __construct()
    {
        $this->memberServices = (new \App\Services\Admin\Member\MemberServices());

        view()->share([
            'main_key' => 'M2',
            'userConfig' => getConfig('user'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.member.index', $this->memberServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view('admin.member.upsert', $this->memberServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->memberServices->dataAction($request);
    }
}
