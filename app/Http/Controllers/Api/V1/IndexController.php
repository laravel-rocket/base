<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StatusRequest;
use App\Http\Responses\Api\V1\Status;

class IndexController extends Controller
{
    /**
     * @param \App\Http\Requests\Api\V1\StatusRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(StatusRequest $request)
    {
        $stats = $request->get('status');

        return Status::ok()->response();
    }
}
