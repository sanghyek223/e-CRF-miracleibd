<?php

namespace App\Services\Register;

use App\Models\Patient;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class RegisterServices
 * @package App\Services
 */
class RegisterServices extends AppServices
{
    public function getPatient($regist_num)
    {
        return thisUser()->patients->where('regist_num', $regist_num)->firstOrFail();
    }

    public function indexService(Request $request)
    {
        $org_code = $request->org_code;
        $regist_num = $request->regist_num;

        $query = (new \App\Services\Patient\PatientServices())->whenPatient();

        if ($org_code) {
            $query->where('org_code', $org_code);
        }

        if ($regist_num) {
            $query->where('regist_num', 'like', "%{$regist_num}%");
        }

        $list = $query->orderByDesc('orgPnum')->paginate(20)->appends($request->query());

        $this->data['list'] = setListSeq($list);
        $this->data['hospitals'] = (new \App\Services\Hospital\HospitalServices())->whenHospitals();

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'patient-delete':
                return $this->patientDelete($request);

            default:
                return notFoundRedirect();
        }
    }

    private function patientDelete($request)
    {
        $this->transaction();

        try {
            $sid = deCryptString($request->sid);

            $patient = $this->getPatient($request)->findOrFail($sid);
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