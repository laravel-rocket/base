<?php
namespace App\Http\Responses\Api\Admin;

use App\Http\Responses\Response as ResponseBase;

class Response extends ResponseBase
{
    protected array $columns = [];

    /**
     * @param \LaravelRocket\Foundation\Models\Base;
     *
     * @return static
     */
    public static function updateWithModel($model): static
    {
        $response = new static([]);

        return $response;
    }

    /**
     * @param \LaravelRocket\Foundation\Models\Base[] $models
     * @param string|null $columnName
     *
     * @return static[]
     */
    public static function updateWithModels(array $models, ?string $columnName = null): static
    {
        $response = [];
        foreach ($models as $model) {
            $response[] = $columnName ? $model->{$columnName} : static::updateWithModel($model);
        }

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
}
