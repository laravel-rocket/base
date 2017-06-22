<?php
namespace App\Http\Responses\Api\V1;

class ListBase extends Response
{
    /** @var Response $itemsResponseModel */
    protected static $itemsResponseModel = Response::class;

    /** @var string $itemsColumnName */
    protected $itemsColumnName = 'items';

    /** @var array $columns */
    protected $columns = [
        'hasNext' => false,
        'offset'  => 0,
        'limit'   => 10,
        'items'   => [],
    ];

    /**
     * @param array $models
     * @param int   $offset
     * @param int   $limit
     * @param bool  $hasNext
     *
     * @return static
     */
    public static function updateListWithModel($models, $offset = 0, $limit = 10, $hasNext = false)
    {
        $items = [];
        foreach ($models as $model) {
            $items[] = (static::$itemsResponseModel)::updateWithModel($model)->toArray();
        }
        $response = new static([
            'hasNext' => $hasNext,
            'offset'  => $offset,
            'limit'   => $limit,
            'items'   => $items,
        ], 200);

        return $response;
    }
}
