<?php

namespace App\Services\Register\FU;

use App\Models\Fu;
use App\Models\FuBX;
use App\Models\FuLAB;
use App\Models\FuENDO;
use App\Models\FuIMG;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class FUServices
 * @package App\Services
 */
class FUServices extends AppServices
{
    private function getPatient(Request $request)
    {
        return (new \App\Services\Register\RegisterServices())->getPatient($request->regist_num);
    }

    public function indexService(Request $request)
    {
        $patient = $this->getPatient($request);
        $query = $patient->FuLIST()->orderBy('FU_visit_d');

        $list = (clone $query)->paginate(20)->appends($request->query());

        $this->data['patient'] = $patient;
        $this->data['list'] = setListSeq($list);
        $this->data['baseIBD'] = count($list) > 0
            ? $patient->FuLIST()->latest('FU_visit_d')->first()?->FU_ibd_type
            : $patient?->BaseDX->IBD_type;

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $patient = $this->getPatient($request);
        $FuList = $patient->FuLIST()->orderBy('FU_visit_d')->get();
        $Fu = $FuList->where('sid', $request->FU_sid)->firstOrFail();

        $data = match ($request->tab) {
            'BX' => $Fu->FuBX,
            'LAB' => $Fu->FuLAB,
            'ENDO' => $Fu->FuENDO,
            'IMG' => $Fu->FuIMG,
            default => notFoundRedirect(),
        };

        $this->data['patient'] = $patient;
        $this->data['FuList'] = $FuList;
        $this->data['Fu'] = $Fu;

        $this->data['register'] = $data;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'Fu-upsert':
                return $this->FuUpsert($request);

            case 'Fu-delete-confirm':
                return $this->FuDeleteConfirm($request);

            case 'Fu-create':
                return $this->FuCreate($request);

            case 'Fu-update':
                return $this->FuUpdate($request);

            case 'Fu-delete':
                return $this->FuDelete($request);

            case 'BX-update':
                return $this->BXUpdate($request);
                
            case 'LAB-update':
                return $this->LABUpdate($request);

            case 'ENDO-update':
                return $this->ENDOUpdate($request);

            case 'IMG-update':
                return $this->IMGUpdate($request);

            default:
                return notFoundRedirect();
        }
    }

    private function makeNextUrl($tab, $regist_num, $FU_sid)
    {
        return route('register.FU.upsert', ['tab' => $tab, 'regist_num' => $regist_num, 'FU_sid' => $FU_sid]);
    }

    private function FuUpsert(Request $request)
    {
        $patient = $this->getPatient($request);
        $decrypt_sid = deCryptString($request->sid);

        $Fu = $patient->FuLIST()->findOrFail($decrypt_sid);
        $Fu = $Fu->additionalData();

        $this->setJsonData('data', [
            $this->ajaxActionData('#Fu-frm',  'sid', enCryptString($Fu->sid)),
            $this->ajaxActionData('#Fu-frm',  'case', 'Fu-update'),
        ]);

        $this->setJsonData('attr', [
            $this->ajaxActionAttr('#Fu-frm #FU_ibd_type',  'disabled', true),
        ]);

        $this->setJsonData('html', [
            $this->ajaxActionHtml('#Fu-submit-btn', '추적 수정'),
        ]);

        $this->setJsonData('input', [
            $this->ajaxActionInput('#FU_ibd_type',  $Fu->FU_ibd_type),
            $this->ajaxActionInput('#FU_visit_d_y',  $Fu->FU_visit_d_y),
            $this->ajaxActionInput('#FU_visit_d_m',  $Fu->FU_visit_d_m),
            $this->ajaxActionInput('#FU_visit_d_d',  $Fu->FU_visit_d_d),
        ]);

        return $this->returnJson();
    }

    private function FuDeleteConfirm(Request $request)
    {
        $patient = $this->getPatient($request);
        $decrypt_sid = deCryptString($request->sid);

        $Fu = $patient->FuLIST()->findOrFail($decrypt_sid);
        $Fu = $Fu->additionalData();

        $view = view('register.FU.include.fu-del-confirm', ['Fu' => $Fu])->render();

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', $view),
        ]);
    }

    private function FuCreate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);

            $Fu = new Fu();
            $Fu->regist_num = $patient->regist_num;
            $Fu->setByData($request);
            $Fu->save();

            $this->dbCommit('Follow-up 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function FuUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $Fu = $patient->FuLIST()->findOrFail($decrypt_sid);
            $Fu->setByData($request);
            $Fu->update();

            $this->dbCommit('Follow-up 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function FuDelete(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);

            $Fu = $patient->FuLIST()->findOrFail($decrypt_sid);
            $Fu->delete();

            $this->dbCommit('Follow-up 삭제');

            return $this->returnJsonData('location', $this->ajaxActionLocation('reload'));
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function BXUpdate(Request $request)
    {
        $this->transaction();

        try {
            $patient = $this->getPatient($request);
            $decrypt_sid = deCryptString($request->sid);
            $decrypt_FU_sid = deCryptString($request->FU_sid);

            $Fu = $patient->FuLIST()->findOrFail($decrypt_FU_sid);

            $bx = $Fu->FuBX()->findOrFail($decrypt_sid);
            $bx->setByData($request);
            $bx->update();

            $this->dbCommit('Follow-up 검체 정보 수정');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('LAB', $patient->regist_num, $Fu->sid))
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
            $decrypt_FU_sid = deCryptString($request->FU_sid);

            $Fu = $patient->FuLIST()->findOrFail($decrypt_FU_sid);

            $bx = $Fu->FuLAB()->findOrFail($decrypt_sid);
            $bx->setByData($request);
            $bx->update();

            $this->dbCommit('Follow-up 검체 획득 시점 Lab 수정');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('ENDO', $patient->regist_num, $Fu->sid))
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
            $decrypt_FU_sid = deCryptString($request->FU_sid);

            $Fu = $patient->FuLIST()->findOrFail($decrypt_FU_sid);

            $bx = $Fu->FuENDO()->findOrFail($decrypt_sid);
            $bx->setByData($request);
            $bx->update();

            $this->dbCommit('Follow-up  검체 획득 시점 검사  수정');

            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $this->makeNextUrl('IMG', $patient->regist_num, $Fu->sid))
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
            $decrypt_FU_sid = deCryptString($request->FU_sid);

            $Fu = $patient->FuLIST()->findOrFail($decrypt_FU_sid);

            $bx = $Fu->FuIMG()->findOrFail($decrypt_sid);
            $bx->setByData($request);
            $bx->update();

            $this->dbCommit('Follow-up  검체 획득 시점 영상  수정');

            $nextRoute = route('register.END.upsert', ['tab' => 'ENDO', 'regist_num' => $patient->regist_num]);
            $location = ($request->next)
                ? $this->ajaxActionLocation('replace', $nextRoute)
                : $this->ajaxActionLocation('reload');

            return $this->returnJsonData('location', $location);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
