<?php

namespace App\Services\Admin\Log;

use App\Models\Application;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class LogServices
 * @package App\Services
 */
class LogServices extends AppServices
{
    public function indexService(Request $request)
    {
        $paginate = 20;
        $query = Application::query();

        if ($request->created_at_s) {
            $query->whereDate('created_at', '>=', $request->created_at_s);
        }

        if ($request->created_at_e) {
            $query->whereDate('created_at', '<=', $request->created_at_e);
        }

        if ($request->org_code) {
            $query->where('org_code', $request->org_code);
        }

        if ($request->application_org_code) {
            $query->where('application_org_code', $request->application_org_code);
        }

        if ($request->confirm) {
            $query->where('confirm', $request->confirm);
        }

        if ($request->applicant) {
            $query->where('applicant', 'like', "%{$request->applicant}%");
        }

        $list = (clone $query)->paginate($paginate)->appends($request->query());

        $confirm_counts = $query->selectRaw('confirm, count(*) as total')->groupBy('confirm')->pluck('total', 'confirm');

        $this->data['list'] = setListSeq($list);
        $this->data['hospitals'] = (new \App\Services\Hospital\HospitalServices())->whenHospitals();
        $this->data['confirm_counts'] = $confirm_counts;

        return $this->data;
    }

    public function detailService(Request $request)
    {
        $application = Application::findOrFail($request->sid);

        $this->data['application'] = $application;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            default:
                return notFoundRedirect();
        }
    }
}
