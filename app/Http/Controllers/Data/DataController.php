<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    private $dataServices;

    public function __construct()
    {
        $this->dataServices = (new \App\Services\Data\DataServices());

        view()->share([
            'main_key' => 'M3',
            'dataConfig' => config('site.data'),
            'patientConfig' => config('site.patient'),
            'registerConfig' => config('site.register'),
        ]);
    }

    public function index(Request $request)
    {
        return view('data.index', $this->dataServices->indexService($request));
    }

    public function application(Request $request)
    {
        return view('data.application.index', $this->dataServices->applicationService($request));
    }

    public function data(Request $request)
    {
        return $this->dataServices->dataAction($request);
    }
}
