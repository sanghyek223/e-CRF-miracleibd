<?php

namespace App\Services\Patient;

use App\Models\Patient;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class PatientServices
 * @package App\Services
 */
class PatientServices extends AppServices
{
    public function whenPatient()
    {
        $user = thisUser();

        // 관리자 아니면 소속 병원 환자들만 노출
        return Patient::when(!isAdmin(), function ($q) use ($user) {
            $q->where('org_code', $user->org_code);
        });
    }

    public function upsertService(Request $request)
    {
        $regist_num = $request->regist_num;

        $this->data['patient'] = empty($regist_num)
            ? null
            : $this->whenPatient()->where('regist_num', $regist_num)->firstOrFail();

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'patient-create':
                return $this->patientCreate($request);

            case 'patient-update':
                return $this->patientUpdate($request);

            case 'patient-delete':
                return $this->patientDelete($request);

            default:
                return notFoundRedirect();
        }
    }

    private function setLocationAction($patient, $next = false)
    {
        if ($next) {
            $replaceUrl = route('register.upsert', ['reg_type' => 'base', 'regist_num' => $patient->regist_num]);
            $locationAction = $this->ajaxActionLocation('replace', $replaceUrl);
        } else {
            $locationAction = $this->ajaxActionLocation('replace', route('register'));
        }

        return $locationAction;
    }

    private function patientCreate($request)
    {
        $this->transaction();

        try {
            $patient = new Patient();
            $patient->setByData($request);
            $patient->save();

            $this->dbCommit('신규 환자 등록');

            return $this->returnJsonData('location', $this->setLocationAction($patient, $request->next));
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function patientUpdate($request)
    {
        $this->transaction();

        try {
            $patient = $this->whenPatient()->findOrFail($request->sid);
            $patient->setByData($request);
            $patient->update();

            $this->dbCommit('환자 정보 수정');

            return $this->returnJsonData('location', $this->setLocationAction($patient, $request->next));
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function patientDelete($request)
    {
        $this->transaction();

        try {
            $patient = $this->whenPatient()->findOrFail($request->sid);
            $patient->delete();

            $this->dbCommit('환자 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }
}