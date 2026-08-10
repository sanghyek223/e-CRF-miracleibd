<?php

namespace App\Services\Data;

use App\Models\Patient;
use App\Models\Fu;
use App\Models\Hospital;
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
        $query = Patient::orderByDesc('sid');
//        $query = Patient::where('org_code', '!= ', $user->org_code)->orderByDesc('sid'); // 본인 기관 제외

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

        if ($request->IBD_age_s || $request->IBD_age_e || $request->IBD_type) {
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
        }

        $this->data['data'] = $query->get();
        $this->data['hospitals'] = Hospital::orderBy('org_name')->get();
        
        $this->data['backup1_count'] = $user->patients()->count();
        $this->data['backup2_count'] = Fu::whereIn('regist_num', $user->patients()->pluck('regist_num'))->count();

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
