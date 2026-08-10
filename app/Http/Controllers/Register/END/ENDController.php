<?php

namespace App\Http\Controllers\Register\END;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ENDController extends Controller
{
    private $ENDServices;

    public function __construct()
    {
        $this->ENDServices = (new \App\Services\Register\END\ENDServices());

        view()->share([
            'type' => 'END',
            'tab' => request()->tab,
        ]);
    }

    public function upsert(Request $request)
    {
        return view('register.END.upsert', $this->ENDServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->ENDServices->dataAction($request);
    }
}