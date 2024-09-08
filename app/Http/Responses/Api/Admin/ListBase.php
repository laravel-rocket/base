<?php

namespace App\Http\Responses\Api\Admin;

class ListBase extends Response
{
    /** @var Response */
    protected static $itemsResponseModel = Response::class;

    protected string $itemsColumnName = 'items';

    protected array $columns = [
        'count' => 0,
        'offset' => 0,
        'limit' => 10,
        'items' => [],
    ];

    /**
     * @param  array  $models
     */
    public static function updateListWithModel(array|\Illuminate\Database\Eloquent\Collection $models, int $offset = 0, int $limit = 10, int $count = 0): static
    {
        $items = [];
        foreach ($models as $model) {
            $items[] = (static::$itemsResponseModel)::updateWithModel($model)->toArray();
        }
        $response = new static([
            'count' => $count,
            'offset' => $offset,
            'limit' => $limit,
            'items' => $items,
        ], 200);

        return $response;
    }
}
