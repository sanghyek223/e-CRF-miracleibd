<?php

namespace App\Services\Register\FASTQ;

use App\Models\FASTQ;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class FASTQServices
 * @package App\Services
 */
class FASTQServices extends AppServices
{
    private function getPatient(Request $request)
    {
        return (new \App\Services\Register\RegisterServices())->getPatient($request->regist_num);
    }

    public function upsertService(Request $request)
    {
        $patient = $this->getPatient($request);

        $data = match ($request->tab) {
            'UPLOAD' => $patient->FASTQ,
            default => notFoundRedirect(),
        };

        $this->data['patient'] = $patient;
        $this->data['register'] = $data;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'UPLOAD-update':
                return $this->UPLOADUpdate($request);

            default:
                return notFoundRedirect();
        }
    }

    private function UPLOADUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $FASTQ = $patient->FASTQ()->findOrFail($decrypt_sid);
            $FASTQ->setByData($request);
            $FASTQ->update();

            $this->dbCommit('Microbiome Data Upload 저장');

            $nextRoute = route('register.BASE.upsert', ['tab' => 'DX', 'regist_num' => $patient->regist_num]);
            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $nextRoute)
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
