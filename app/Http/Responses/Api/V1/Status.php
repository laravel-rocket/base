<?php
namespace App\Http\Responses\Api\V1;

use Illuminate\Support\Arr;

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
            'type'          => Arr::get($extraData, 'type', ''),
            'title'         => Arr::get($extraData, 'title', ''),
            'status'        => (int) Arr::get($extraData, 'status', 0),
            'errorCode'     => (int) Arr::get($error, 'code'),
            'detail'        => empty($message) ? Arr::get($error, 'message', '') : $message,
            'invalidParams' => Arr::get($extraData, 'invalidParams', []),
        ], Arr::get($error, 'statusCode', 400));

        return $response;
    }

    public static function ok($message = '', $extraData = [], $statusCode = 200)
    {
        $response = new static([
            'isSuccess'     => true,
            'type'          => Arr::get($extraData, 'type', ''),
            'title'         => Arr::get($extraData, 'title', ''),
            'status'        => (int) Arr::get($extraData, 'status', 0),
            'errorCode'     => 0,
            'detail'        => $message,
            'invalidParams' => [],
        ], $statusCode);

        return $response;
    }
}
