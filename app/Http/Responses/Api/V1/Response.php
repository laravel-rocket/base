<?php
namespace App\Http\Responses\Api\V1;

use App\Http\Responses\Response as ResponseBase;

class Response extends ResponseBase
{
    protected $columns = [];

    /**
     * @param \LaravelRocket\Foundation\Models\Base;
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([]);

        return $response;
    }
}
