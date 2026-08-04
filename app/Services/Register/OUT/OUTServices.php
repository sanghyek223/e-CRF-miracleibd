<?php

namespace App\Services\Register\OUT;

use App\Models\OutMED;
use App\Models\OutOP;
use App\Models\OutV;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class OUTServices
 * @package App\Services
 */
class OUTServices extends AppServices
{
    public function getData(Request $request)
    {
        return match ($request->tab) {
            'MED' => $this->getMED($request),
            'OP' => $this->getOP($request),
            'V' => $this->getV($request),
            default => notFoundRedirect(),
        };
    }

    private function getMED(Request $request)
    {
        return $this->data;
    }

    private function getOP(Request $request)
    {
        return $this->data;
    }

    private function getV(Request $request)
    {
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
