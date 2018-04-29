<?php
namespace App\Exceptions\Api\V1;

use App\Http\Responses\Api\V1\Status;

class APIErrorException extends \App\Exceptions\Api\APIErrorException
{
    /**
     * @return \Response|\Illuminate\Http\JsonResponse
     */
    public function getErrorResponse()
    {
        return Status::error($this->errorName, $this->userMessage, $this->extraData)->response();
    }

    /**
     * @return array
     */
    protected function errorConfig()
    {
        $error = config('api.errors.'.$this->errorName);
        if (empty($error)) {
            $error = config('api.errors.unknown');
        }

        return $error;
    }
}
