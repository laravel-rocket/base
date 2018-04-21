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

    protected static function date($date)
    {
        if ($date instanceof \DateTime) {
            return $date->format('Y-m-d');
        }

        return null;
    }

    protected static function dateTime($dateTime)
    {
        if ($dateTime instanceof \DateTime) {
            return $dateTime->format('U');
        }

        return null;
    }

    protected static function generateArray(array $items, string $class)
    {
        $ret = [];
        foreach ($items as $item) {
            $ret[] = $class::updateWithModel($item);
        }

        return $ret;
    }
}
