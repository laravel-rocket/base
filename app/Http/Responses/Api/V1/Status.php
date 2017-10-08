<?php
namespace App\Http\Responses\Api\V1;

class Status extends Response
{
    protected $columns         = [
        'isSuccess'     => true,
        'type'          => '',
        'title'         => '',
        'status'        => '',
        'errorCode'     => 0,
        'detail'        => '',
        'invalidParams' => [],
    ];

    protected $optionalColumns = [
        'type',
        'title',
        'status',
        'errorCode',
        'detail',
        'invalidParams',
    ];

    public static function error($error, $message, $extraData = [])
    {
        $error = config('api.errors.'.$error);
        if (empty($error)) {
            $error = config('api.errors.unknown');
        }

        $response = new static([
            'isSuccess'     => false,
            'type'          => array_get($extraData, 'type', ''),
            'title'         => array_get($extraData, 'title', ''),
            'status'        => (int) array_get($extraData, 'status', 0),
            'errorCode'     => (int) array_get($error, 'code'),
            'detail'        => empty($message) ? array_get($error, 'message', '') : $message,
            'invalidParams' => array_get($extraData, 'invalidParams', []),
        ], array_get($error, 'statusCode', 400));

        return $response;
    }

    public static function ok($message = '', $extraData = [], $statusCode = 200)
    {
        $response = new static([
            'isSuccess'     => true,
            'type'          => array_get($extraData, 'type', ''),
            'title'         => array_get($extraData, 'title', ''),
            'status'        => (int) array_get($extraData, 'status', 0),
            'errorCode'     => 0,
            'detail'        => $message,
            'invalidParams' => [],
        ], $statusCode);

        return $response;
    }
}
