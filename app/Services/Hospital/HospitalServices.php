<?php

namespace App\Services\Hospital;

use App\Models\Hospital;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class HospitalsServices
 * @package App\Services
 */
class HospitalServices extends AppServices
{
    public function whenHospitals()
    {
        $user = thisUser();

        // 관리자만 전체 병원 리스트 노출
        return Hospital::when(!isAdmin(), function ($q) use ($user) {
            $q->where('org_code', $user->org_code);
        })->orderBy('org_name')->get()->keyBy('sid');
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            default:
                return notFoundRedirect();
        }
    }
}