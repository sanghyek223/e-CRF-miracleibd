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
    }

    public function index(Request $request)
    {
        return view('register.index', $this->patientServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        if ($request->type === 'FU') {
            return $this->FuUpsert($request);
        }

        return view('register.upsert', $this->patientServices->upsertService($request));
    }

    private function FuUpsert(Request $request)
    {
        $data = $this->patientServices->FuUpsertService($request);

        return ($request->tab === 'LIST')
            ? view('register.FU.LIST', $data)
            : view('register.FU.upsert', $data);
    }

    public function data(Request $request)
    {
        return $this->patientServices->dataAction($request);
    }
}
