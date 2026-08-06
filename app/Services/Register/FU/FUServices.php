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
    public function getData(Request $request, $patient)
    {
        return match ($request->tab) {
            'LIST' => $this->getFollowUpList($request, $patient),
            'BX' => $patient->FuBX,
            'LAB' => $patient->FuLAB,
            'ENDO' => $patient->FuENDO,
            'IMG' => $patient->FuIMG,
            default => notFoundRedirect(),
        };
    }

    private function getFollowUpList(Request $request, $patient)
    {
        $query = $patient->FuLIST()->whereNull('deleted_at');

        $list = $query->orderByDesc('FU_visit_d')->paginate(20)->appends($request->query());

        $this->data['list'] = setListSeq($list);

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

            default:
                return notFoundRedirect();
        }
    }

    private function getPatient(Request $request)
    {
        return (new \App\Services\Register\RegisterServices())->getPatient($request->regist_num);
    }

    private function FuUpsert(Request $request)
    {
        $patient = $this->getPatient($request);
        $decrypt_sid = deCryptString($request->sid);

        $Fu = $patient->FuLIST()->findOrFail($decrypt_sid);
        $Fu = $Fu->additionalData();

        $this->setJsonData('data', [
            $this->ajaxActionData('#Fu-frm',  'sid', enCryptString($Fu->sid)),
        ]);

        $this->setJsonData('input', [
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

        $view = view('register.FU.include.fu-list-del-confirm', ['Fu' => $Fu])->render();

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

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}
