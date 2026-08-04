<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $patientServices;

    public function __construct()
    {
        $this->patientServices = (new \App\Services\Register\RegisterServices());

        view()->share([
            'main_key' => 'M2',
            'patientConfig' => config('site.patient'),
            'registerConfig' => config('site.register'),
        ]);
    }

    public function index(Request $request)
    {
        return view('register.index', $this->patientServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        $data = $this->patientServices->upsertService($request);
        $FU_LIST = ($data['type'] === 'FU' && $data['tab'] === 'LIST');

        return $FU_LIST
            ? view('register.FU.LIST', $data)
            : view('register.upsert', $data);
    }

    public function data(Request $request)
    {
        return $this->patientServices->dataAction($request);
    }
}
