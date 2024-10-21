<?php

namespace App\Http\Responses\Api\V1;

use App\Http\Responses\Response as ResponseBase;

class Response extends ResponseBase
{
    protected array $columns = [];

    /**
     * @param \LaravelRocket\Foundation\Models\Base;
     */
    public static function updateWithModel($model): static
    {
        $response = new static([]);

        return $response;
    }

    protected static function date($date): ?string
    {
        if ($date instanceof \DateTime) {
            return $date->format('Y-m-d');
        }

        return null;
    }

    protected static function dateTime($dateTime): ?string
    {
        if ($dateTime instanceof \DateTime) {
            return $dateTime->format('U');
        }

        return null;
    }

    protected static function generateArray(array $items, string $class): array
    {
        $ret = [];
        foreach ($items as $item) {
            $ret[] = $class::updateWithModel($item);
        }

        return $ret;
    }
}
