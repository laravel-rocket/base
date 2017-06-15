<?php
namespace App\Http\Requests\Api\V1;

use Zend\Diactoros\ServerRequest;

class PsrServerRequest extends ServerRequest
{
    public static function createFromRequest(Request $request, $params = null)
    {
        if (is_null($params)) {
            $params = $request->all();
        }

        return new static($request->server->all(), [], $request->fullUrl(), $request->getMethod(), 'php://input', [],
            $request->cookies->all(), $request->query->all(), $params);
    }
}
