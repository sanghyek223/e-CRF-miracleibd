<?php

namespace App\Services\Register\OUT;

use App\Models\OutMED;
use App\Models\OutOP;
use App\Models\OutV;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class OUTServices
 * @package App\Services
 */
class OUTServices extends AppServices
{
    private function getPatient(Request $request)
    {
        return (new \App\Services\Register\RegisterServices())->getPatient($request->regist_num);
    }

    public function upsertService(Request $request)
    {
        $patient = $this->getPatient($request);

        $data = match ($request->tab) {
            'MED' => $patient->OutMED,
            'OP' => $patient->OutOP,
            'V' => $patient->OutV,
            default => notFoundRedirect(),
        };

        $this->data['patient'] = $patient;
        $this->data['register'] = $data;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'op-list-add':
                return $this->OPListHtml($request);

            case 'v-list-add':
                return $this->VListHtml($request);

            case 'MED-update':
                return $this->MEDUpdate($request);

            case 'OP-update':
                return $this->OPUpdate($request);

            case 'V-update':
                return $this->VUpdate($request);

            default:
                return notFoundRedirect();
        }
    }

    private function makeNextUrl($tab, $regist_num)
    {
        return route('register.OUT.upsert', ['tab' => $tab, 'regist_num' => $regist_num]);
    }

    private function OPListHtml(Request $request)
    {
        $view = view('register.OUT.include.OP-list', [
            'eq' => $request->eq,
            'register' => null,
        ])->render();

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('#op-list-tbody', $view),
        ]);
    }

    private function VListHtml(Request $request)
    {
        $view = view('register.OUT.include.V-list', [
            'eq' => $request->eq,
            'register' => null,
        ])->render();

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('#v-list-tbody', $view),
        ]);
    }

    private function MEDUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $med = $patient->OutMED()->findOrFail($decrypt_sid);
            $med->setByData($request);
            $med->update();

            $this->dbCommit('Medication 저장');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('OP', $patient->regist_num))
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function OPUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $op = $patient->OutOP()->findOrFail($decrypt_sid);
            $op->setByData($request);
            $op->update();

            $this->dbCommit('Surgery 저장');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('V', $patient->regist_num))
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function VUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $v = $patient->OutV()->findOrFail($decrypt_sid);
            $v->setByData($request);
            $v->update();

            $this->dbCommit('ER/Admission 저장');

            $nextRoute = route('register.FU.upsert', ['tab' => 'LIST', 'regist_num' => $patient->regist_num]);
            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $nextRoute)
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
