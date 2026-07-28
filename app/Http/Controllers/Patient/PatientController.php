<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private $patientServices;

    public function __construct()
    {
        $this->patientServices = (new \App\Services\Patient\PatientServices());

        view()->share([
            'main_key' => 'M1',
            'patientConfig' => config('site.patient'),
        ]);
    }

    public function upsert(Request $request)
    {
        return view('patient.upsert', $this->patientServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->patientServices->dataAction($request);
    }
}
