<?php

namespace App\Http\Controllers\Register\FU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FUController extends Controller
{
    private $FUServices;

    public function __construct()
    {
        $this->FUServices = (new \App\Services\Register\FU\FUServices());

        $FU_sub_tabs = config('site.register.tab.FU');
        unset($FU_sub_tabs['LIST']);

        view()->share([
            'FU_sub_tabs' => $FU_sub_tabs,
            'type' => 'FU',
            'tab' => request()->tab,
        ]);
    }

    public function index(Request $request)
    {
        return view('register.FU.index', $this->FUServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view('register.FU.upsert', $this->FUServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->FUServices->dataAction($request);
    }
}