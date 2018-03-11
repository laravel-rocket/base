<?php
namespace App\Http\Responses\Api\Admin;

class ListBase extends Response
{
    /** @var Response $itemsResponseModel */
    protected static $itemsResponseModel = Response::class;

    /** @var string $itemsColumnName */
    protected $itemsColumnName = 'items';

    /** @var array $columns */
    protected $columns = [
        'count'  => 0,
        'offset' => 0,
        'limit'  => 10,
        'items'  => [],
    ];

    /**
     * @param array $models
     * @param int   $offset
     * @param int   $limit
     * @param int   $count
     *
     * @return static
     */
    public static function updateListWithModel($models, $offset = 0, $limit = 10, $count = 0)
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
