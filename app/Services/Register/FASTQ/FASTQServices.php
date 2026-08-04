<?php

namespace App\Services\Register\FASTQ;

use App\Models\FASTQ;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class FASTQServices
 * @package App\Services
 */
class FASTQServices extends AppServices
{
    public function getData(Request $request)
    {
        return match ($request->tab) {
            'UPLOAD' => $this->getUPLOAD($request),
            default => notFoundRedirect(),
        };
    }

    private function getUPLOAD(Request $request)
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
