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
            'dataConfig' => config('site.data'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.log.index', $this->logServices->indexService($request));
    }

    public function detail(Request $request)
    {
        return view('admin.log.detail', $this->logServices->detailService($request));
    }

    public function data(Request $request)
    {
        return $this->logServices->dataAction($request);
    }
}
