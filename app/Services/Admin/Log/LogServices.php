<?php

namespace App\Services\Admin\Log;

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
        return $this->data;
    }

    public function upsertService(Request $request)
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
