<?php
namespace App\Http\Responses\Api\Admin;

class ListBase extends Response
{
    /** @var Response $itemsResponseModel */
    protected static $itemsResponseModel = Response::class;

    /** @var string $itemsColumnName */
    protected string $itemsColumnName = 'items';

    /** @var array $columns */
    protected array $columns = [
        'count'  => 0,
        'offset' => 0,
        'limit'  => 10,
        'items'  => [],
    ];

    /**
     * @param array $models
     * @param int $offset
     * @param int $limit
     * @param int $count
     *
     * @return static
     */
    public static function updateListWithModel(array|\Illuminate\Database\Eloquent\Collection $models, int $offset = 0, int $limit = 10, int $count = 0): static
    {
        $items = [];
        foreach ($models as $model) {
            $items[] = (static::$itemsResponseModel)::updateWithModel($model)->toArray();
        }
        $response = new static([
            'count'  => $count,
            'offset' => $offset,
            'limit'  => $limit,
            'items'  => $items,
        ], 200);

        return $response;
    }
}
