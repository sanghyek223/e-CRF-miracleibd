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
    public function whenHospitals()
    {
        return(new \App\Services\Hospital\HospitalServices())->whenHospitals();
    }

    public function whenPatient()
    {
        return(new \App\Services\Patient\PatientServices())->whenPatient();
    }

    public function getPatient($regist_num)
    {
        $user = thisUser();
        return $user->patients->where('regist_num', $regist_num)->firstOrFail();
    }

    public function indexService(Request $request)
    {
        $user = thisUser();

        $org_code = $request->org_code;
        $regist_num = $request->regist_num;

        $query = $this->whenPatient();

        if ($org_code) {
            $query->where('org_code', $org_code);
        }

        if ($regist_num) {
            $query->where('regist_num', 'like', "%{$regist_num}%");
        }

        $list = $query->orderByDesc('orgPnum')->paginate(20)->appends($request->query());

        $this->data['list'] = setListSeq($list);
        $this->data['hospitals'] = $this->whenHospitals();

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $registerConfig = config('site.register');
        $regist_num = $request->regist_num;
        $type = $request->type;
        $tab = $request->tab;

        $tabClass = "App\\Services\\Register\\{$type}\\{$type}Services";

        $patient = $this->whenPatient()->where('regist_num', $regist_num)->firstOrFail();
        $data = (new $tabClass())->getData($request, $patient);

        $this->data['type'] = $type;
        $this->data['tab'] = $tab;

        $this->data['patient'] = $patient;
        $this->data['register'] = $data;

        $this->data['regist_num'] = $regist_num;
        $this->data['page_title'] = $registerConfig['type'][$type]['name'];

        return $this->data;
    }

    public function FuUpsertService(Request $request)
    {
        $registerConfig = config('site.register');
        $regist_num = $request->regist_num;
        $type = $request->type;
        $tab = $request->tab;

        $tabClass = "App\\Services\\Register\\{$type}\\{$type}Services";

        $patient = $this->whenPatient()->where('regist_num', $regist_num)->firstOrFail();
        $this->data = (new $tabClass())->getData($request, $patient);

        $this->data['type'] = $type;
        $this->data['tab'] = $tab;

        $this->data['patient'] = $patient;

        $this->data['regist_num'] = $regist_num;
        $this->data['page_title'] = $registerConfig['type'][$type]['name'];

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        $type = $request->type;

        if (!empty($type)) {
            $tabClass = "App\\Services\\Register\\{$type}\\{$type}Services";
            return (new $tabClass())->dataAction($request);
        }

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

            $patient = $this->whenPatient()->where('regist_num', $request->num)->findOrFail($sid);
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