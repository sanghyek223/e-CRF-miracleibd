<?php

namespace App\Services\Register\BASE;

use App\Models\BaseDX;
use App\Models\BaseENDO;
use App\Models\BaseIMG;
use App\Models\BaseLAB;
use App\Models\BaseNTR;
use App\Models\BaseEVN;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class BASEServices
 * @package App\Services
 */
class BASEServices extends AppServices
{
    private function getPatient(Request $request)
    {
        return (new \App\Services\Register\RegisterServices())->getPatient($request->regist_num);
    }

    public function upsertService(Request $request)
    {
        $patient = $this->getPatient($request);

        $data = match ($request->tab) {
            'DX' => $patient->BaseDX,
            'ENDO' => $patient->BaseENDO,
            'IMG' => $patient->BaseIMG,
            'LAB' => $patient->BaseLAB,
            'NTR' => $patient->BaseNTR,
            'EVN' => $patient->BaseEVN,
            default => notFoundRedirect(),
        };

        $this->data['patient'] = $patient;
        $this->data['register'] = $data;

        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'DX-bio-detail-add':
                return $this->DXBioDetailHtml($request);

            case 'DX-update':
                return $this->DXUpdate($request);

            case 'ENDO-update':
                return $this->ENDOUpdate($request);

            case 'IMG-update':
                return $this->IMGUpdate($request);

            case 'LAB-update':
                return $this->LABUpdate($request);

            case 'NTR-update':
                return $this->NTRUpdate($request);
                
            case 'EVN-update':
                return $this->EVNUpdate($request);

            default:
                return notFoundRedirect();
        }
    }

    private function makeNextUrl($tab, $regist_num)
    {
        return route('register.BASE.upsert', ['tab' => $tab, 'regist_num' => $regist_num]);
    }

    private function DXBioDetailHtml(Request $request)
    {
        $view = view('register.BASE.include.DX-bio-detail', [
            'eq' => $request->eq,
            'register' => null,
        ])->render();

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('#bio-detail-tbody', $view),
        ]);
    }

    private function DXUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $dx = $patient->BaseDX()->findOrFail($decrypt_sid);
            $dx->setByData($request);
            $dx->update();

            $this->dbCommit('진단 시점 정보 저장');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('ENDO', $patient->regist_num))
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function ENDOUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $endo = $patient->BaseENDO()->findOrFail($decrypt_sid);
            $endo->setByData($request);
            $endo->update();

            $this->dbCommit('진단 시점 검사 저장');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('IMG', $patient->regist_num))
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function IMGUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $img = $patient->BaseIMG()->findOrFail($decrypt_sid);
            $img->setByData($request);
            $img->update();

            $this->dbCommit('진단 시점 영상 저장');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('LAB', $patient->regist_num))
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function LABUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $lab = $patient->BaseLAB()->findOrFail($decrypt_sid);
            $lab->setByData($request);
            $lab->update();

            $this->dbCommit('진단 시점 Lab 저장');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('NTR', $patient->regist_num))
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function NTRUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $ntr = $patient->BaseNTR()->findOrFail($decrypt_sid);
            $ntr->setByData($request);
            $ntr->update();

            $this->dbCommit('환경 인자 설문 저장');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('EVN', $patient->regist_num))
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function EVNUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $evn = $patient->BaseEVN()->findOrFail($decrypt_sid);
            $evn->setByData($request);
            $evn->update();

            $this->dbCommit('영양 진자 설문 저장');

            $nextRoute = route('register.OUT.upsert', ['tab' => 'MED', 'regist_num' => $patient->regist_num]);
            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $nextRoute)
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
