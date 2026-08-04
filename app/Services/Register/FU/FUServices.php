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
    public function getData(Request $request)
    {
        return match ($request->tab) {
            'LIST' => $this->getLIST($request),
            'BX' => $this->getBX($request),
            'LAB' => $this->getLAB($request),
            'ENDO' => $this->getENDO($request),
            'IMG' => $this->getIMG($request),
            default => notFoundRedirect(),
        };
    }

    private function getLIST(Request $request)
    {
        return $this->data;
    }

    private function getBX(Request $request)
    {
        return $this->data;
    }

    private function getLAB(Request $request)
    {
        return $this->data;
    }

    private function getENDO(Request $request)
    {
        return $this->data;
    }

    private function getIMG(Request $request)
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
