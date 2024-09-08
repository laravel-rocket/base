<?php
namespace App\Http\Responses\Api\Admin;

use Illuminate\Support\Arr;

class Status extends Response
{
    protected array $columns         = [
        'isSuccess'     => true,
        'type'          => '',
        'title'         => '',
        'status'        => '',
        'errorCode'     => 0,
        'detail'        => '',
        'invalidParams' => [],
    ];

    protected array $optionalColumns = [
        'type',
        'title',
        'status',
        'errorCode',
        'detail',
        'invalidParams',
    ];

    public static function error(string $error, string $message, array $extraData = []): static
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

    public static function ok(string $message = '', array $extraData = [], int $statusCode = 200): static
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
