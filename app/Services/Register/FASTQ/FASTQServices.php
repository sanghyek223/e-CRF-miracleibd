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
    public function getData(Request $request, $patient)
    {
        return match ($request->tab) {
            'UPLOAD' => $patient->FASTQ,
            default => notFoundRedirect(),
        };
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

    private function getPatient(Request $request)
    {
        return (new \App\Services\Register\RegisterServices())->getPatient($request->regist_num);
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

            $this->dbCommit('Microbiome Data Upload 수정');

            $nextRoute = route('register', ['type' => 'BASE', 'tab' => 'DX', 'regist_num' => $patient->regist_num]);
            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $nextRoute)
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다',
                'location' => $location,
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
