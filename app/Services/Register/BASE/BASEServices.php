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
    public function getData(Request $request, $patient)
    {
        return match ($request->tab) {
            'DX' => $patient->BaseDX,
            'ENDO' => $patient->BaseENDO,
            'IMG' => $patient->BaseIMG,
            'LAB' => $patient->BaseLAB,
            'NTR' => $patient->BaseNTR,
            'EVN' => $patient->BaseEVN,
            default => notFoundRedirect(),
        };
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

    private function getPatient(Request $request)
    {
        return (new \App\Services\Register\RegisterServices())->getPatient($request->regist_num);
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

            $this->dbCommit('진단 시점 정보 수정');

            $nextRoute = route('register.upsert', ['type' => $request->type, 'tab' => 'ENDO', 'regist_num' => $patient->regist_num]);
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

    private function ENDOUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $endo = $patient->BaseENDO()->findOrFail($decrypt_sid);
            $endo->setByData($request);
            $endo->update();

            $this->dbCommit('진단 시점 검사 수정');

            $nextRoute = route('register.upsert', ['type' => $request->type, 'tab' => 'IMG', 'regist_num' => $patient->regist_num]);
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

    private function IMGUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $img = $patient->BaseIMG()->findOrFail($decrypt_sid);
            $img->setByData($request);
            $img->update();

            $this->dbCommit('진단 시점 영상 수정');

            $nextRoute = route('register.upsert', ['type' => $request->type, 'tab' => 'LAB', 'regist_num' => $patient->regist_num]);
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

    private function LABUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $lab = $patient->BaseLAB()->findOrFail($decrypt_sid);
            $lab->setByData($request);
            $lab->update();

            $this->dbCommit('진단 시점 Lab 수정');

            $nextRoute = route('register.upsert', ['type' => $request->type, 'tab' => 'NTR', 'regist_num' => $patient->regist_num]);
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

    private function NTRUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $ntr = $patient->BaseNTR()->findOrFail($decrypt_sid);
            $ntr->setByData($request);
            $ntr->update();

            $this->dbCommit('환경 인자 설문 수정');

            $nextRoute = route('register.upsert', ['type' => $request->type, 'tab' => 'EVN', 'regist_num' => $patient->regist_num]);
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

    private function EVNUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $evn = $patient->BaseEVN()->findOrFail($decrypt_sid);
            $evn->setByData($request);
            $evn->update();

            $this->dbCommit('영양 진자 설문 수정');

            $nextRoute = route('register.upsert', ['type' => 'OUT', 'tab' => 'MED', 'regist_num' => $patient->regist_num]);
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
