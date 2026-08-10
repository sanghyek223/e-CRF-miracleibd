<?php

namespace App\Http\Controllers\Register\BASE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BASEController extends Controller
{
    private $BASEServices;

    public function __construct()
    {
        $this->BASEServices = (new \App\Services\Register\BASE\BASEServices());

        view()->share([
            'type' => 'BASE',
            'tab' => request()->tab,
        ]);
    }

    public function upsert(Request $request)
    {
        return view('register.BASE.upsert', $this->BASEServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->BASEServices->dataAction($request);
    }
}