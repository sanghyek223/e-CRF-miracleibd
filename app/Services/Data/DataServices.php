<?php

namespace App\Services\Data;

use App\Models\Patient;
use App\Models\Hospital;
use App\Models\Application;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class DataServices
 * @package App\Services
 */
class DataServices extends AppServices
{
    public function indexService(Request $request)
    {
        $user = thisUser();
        $my_org_code = $user->org_code;

        $hospitals = Hospital::orderBy('org_name')->get();
        $query = Patient::orderByDesc('sid');
        // 본인 기관 제외
//        $hospitals = Hospital::orderBy('org_name')->where('org_code', '!= ', $my_org_code)->get();
//        $query = Patient::where('org_code', '!= ', $my_org_code)->orderByDesc('sid');

        if ($request->org_code) {
            $query->whereIn('org_code', $request->org_code);
        }

        if ($request->created_at_s) {
            $query->whereDate('created_at', '>=', $request->created_at_s);
        }

        if ($request->created_at_e) {
            $query->whereDate('created_at', '<=', $request->created_at_e);
        }

        if ($request->sex) {
            $query->whereIn('sex', $request->sex);
        }

        $query->whereHas('BaseDX', function ($q) use ($request) {
            if ($request->IBD_age_s) {
                $q->where('IBD_age', '>=', $request->IBD_age_s);
            }

            if ($request->IBD_age_e) {
                $q->where('IBD_age', '<=', $request->IBD_age_e);
            }

            if ($request->IBD_type) {
                $q->whereIn('IBD_type', $request->IBD_type);
            }
        });

        // 검색 데이터 기준 group data
        $data = $query->selectRaw('org_code, count(*) as total')->groupBy('org_code')->get()->keyBy('org_code');

        // 나의 (같은 기관 코드) 환자 리스트
        $myPatients = $user->patients()->withCount('FuLIST as Fu_count')->get();

        $this->data['data'] = $data;
        $this->data['hospitals'] = $hospitals;
        $this->data['myPatients'] = $myPatients;

        $this->data['backup1_count'] = $myPatients->count();
        $this->data['backup2_count'] = $myPatients->sum('Fu_count');

        return $this->data;
    }

    public function applicationService(Request $request)
    {
        $search_url = $request->search_url;
        $application_org_code = $request->application_org_code;
        $parse_data_query_string = parse_url($search_url, PHP_URL_QUERY);

        parse_str($parse_data_query_string, $data_params); // parameter 추출

        $hospital = Hospital::orderBy('org_name')->where('org_code', $application_org_code)->firstOrFail();
        $query = $hospital->patients()->orderByDesc('sid');

        if (!empty($data_params['created_at_s'])) {
            $query->whereDate('created_at', '>=', $data_params['created_at_s']);
        }

        if (!empty($data_params['created_at_e'])) {
            $query->whereDate('created_at', '<=', $data_params['created_at_e']);
        }

        if (!empty($data_params['sex'])) {
            $query->whereIn('sex', $data_params['sex']);
        }

        $query->whereHas('BaseDX', function ($q) use ($data_params) {
            if (!empty($data_params['IBD_age_s'])) {
                $q->where('IBD_age', '>=', $data_params['IBD_age_s']);
            }

            if (!empty($data_params['IBD_age_e'])) {
                $q->where('IBD_age', '<=', $data_params['IBD_age_e']);
            }

            if (!empty($data_params['IBD_type'])) {
                $q->whereIn('IBD_type', $data_params['IBD_type']);
            }
        });

        // 신청 데이터 기준 환자 리스트
        $patients = (clone $query)->withCount('FuLIST as Fu_count')->get();

        // 신청 데이터 기준 환자 리스트 에서 파일 업로드 있는 데이터만
        $patientsFASTQ = $query->with('FASTQ')->whereHas('FASTQ', fn($q) => $q->hasFile())->get();

        $this->data['search_url'] = $search_url;
        $this->data['search_params'] = [ // 검색 파라미터 값 노출 & 데이터 저장용
            'application_org_code' => $application_org_code,

            'created_at' => [
                'created_at_s' => $data_params['created_at_s'] ?? '',
                'created_at_e' => $data_params['created_at_e'] ?? '',
            ],

            'sex' => $data_params['sex'] ?? [],

            'IBD_age' => [
                'IBD_age_s' => $data_params['IBD_age_s'] ?? '',
                'IBD_age_e' => $data_params['IBD_age_e'] ?? '',
            ],

            'IBD_type' => $data_params['IBD_type'] ?? '',
        ];

        $this->data['hospital'] = $hospital;
        $this->data['patients'] = $patients;
        $this->data['patientsFASTQ'] = $patientsFASTQ;

        $this->data['backup1_count'] = $patients->count();
        $this->data['backup2_count'] = $patients->sum('Fu_count');

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'application-create':
                return $this->applicationCreate($request);

            default:
                return notFoundRedirect();
        }
    }

    public function applicationCreate(Request $request)
    {
        $this->transaction();

        try {
            $application = new Application();
            $application->setByData($request);
            $application->save();

            $this->dbCommit('타 기관 데이터 신청 접수');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '신청 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $request->search_url)
            ]);
        } catch (\Exceptio $e) {
            return $this->dbRollback($e);
        }
    }
}