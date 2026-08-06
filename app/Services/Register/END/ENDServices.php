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
    public function getData(Request $request, $patient)
    {
        return match ($request->tab) {
            'ENDO' => $patient->EndENDO,
            'MED' => $patient->EndMED,
            default => notFoundRedirect(),
        };
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

    private function getPatient(Request $request)
    {
        return (new \App\Services\Register\RegisterServices())->getPatient($request->regist_num);
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

            $this->dbCommit('마지막 내시경 수정');

            $nextRoute = route('register.upsert', ['type' => $request->type, 'tab' => 'MED', 'regist_num' => $patient->regist_num]);
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

    private function MEDUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $med = $patient->EndMED()->findOrFail($decrypt_sid);
            $med->setByData($request);
            $med->update();

            $this->dbCommit('마지막 F/U 시점의 약제 사용 수정');

            $nextRoute = route('register.upsert', ['type' => 'FASTQ', 'tab' => 'UPLOAD', 'regist_num' => $patient->regist_num]);
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
