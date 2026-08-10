<?php

namespace App\Services\Register\END;

use App\Models\EndENDO;
use App\Models\EndMED;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class ENDServices
 * @package App\Services
 */
class ENDServices extends AppServices
{
    private function getPatient(Request $request)
    {
        return (new \App\Services\Register\RegisterServices())->getPatient($request->regist_num);
    }

    public function upsertService(Request $request)
    {
        $patient = $this->getPatient($request);

        $data = match ($request->tab) {
            'ENDO' => $patient->EndENDO,
            'MED' => $patient->EndMED,
            default => notFoundRedirect(),
        };

        $this->data['patient'] = $patient;
        $this->data['register'] = $data;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'ENDO-update':
                return $this->ENDOUpdate($request);

            case 'MED-update':
                return $this->MEDUpdate($request);

            default:
                return notFoundRedirect();
        }
    }

    private function makeNextUrl($tab, $regist_num)
    {
        return route('register.END.upsert', ['tab' => $tab, 'regist_num' => $regist_num]);
    }

    private function ENDOUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $endo = $patient->EndENDO()->findOrFail($decrypt_sid);
            $endo->setByData($request);
            $endo->update();

            $this->dbCommit('마지막 내시경 저장');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('MED', $patient->regist_num))
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function MEDUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $med = $patient->EndMED()->findOrFail($decrypt_sid);
            $med->setByData($request);
            $med->update();

            $this->dbCommit('마지막 F/U 시점의 약제 사용 저장');

            $nextRoute = route('register.FASTQ.upsert', ['tab' => 'UPLOAD', 'regist_num' => $patient->regist_num]);
            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $nextRoute)
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
