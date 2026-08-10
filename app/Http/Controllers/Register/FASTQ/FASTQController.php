<?php

namespace App\Http\Controllers\Register\FASTQ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FASTQController extends Controller
{
    private $FASTQServices;

    public function __construct()
    {
        $this->FASTQServices = (new \App\Services\Register\FASTQ\FASTQServices());

        view()->share([
            'type' => 'FASTQ',
            'tab' => request()->tab,
        ]);
    }

    public function upsert(Request $request)
    {
        return view('register.FASTQ.upsert', $this->FASTQServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->FASTQServices->dataAction($request);
    }
}