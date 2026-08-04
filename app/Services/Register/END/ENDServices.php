<?php

namespace App\Services\Register\END;

use App\Models\EndENDO;
use App\Models\EndMED;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class ENDServices
 * @package App\Services
 */
class ENDServices extends AppServices
{
    public function getData(Request $request)
    {
        return match ($request->tab) {
            'ENDO' => $this->getENDO($request),
            'MED' => $this->getMED($request),
            default => notFoundRedirect(),
        };
    }

    private function getENDO(Request $request)
    {
        return $this->data;
    }

    private function getMED(Request $request)
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
