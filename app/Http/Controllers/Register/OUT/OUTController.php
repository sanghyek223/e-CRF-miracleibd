<?php

namespace App\Http\Controllers\Register\OUT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OUTController extends Controller
{
    private $OUTServices;

    public function __construct()
    {
        $this->OUTServices = (new \App\Services\Register\OUT\OUTServices());

        view()->share([
            'type' => 'OUT',
            'tab' => request()->tab,
        ]);
    }

    public function upsert(Request $request)
    {
        return view('register.OUT.upsert', $this->OUTServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->OUTServices->dataAction($request);
    }
}