<?php

namespace App\Http\Controllers\Admin\Log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogController extends Controller
{
    private $logServices;

    public function __construct()
    {
        $this->logServices = (new \App\Services\Admin\Log\LogServices());

        view()->share([
            'main_key' => 'M1',
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.log.index', $this->logServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view('admin.log.upsert', $this->logServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->logServices->dataAction($request);
    }
}
