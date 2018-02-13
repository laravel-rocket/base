<?php
namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;

/**
 * @method  \App\Models\File[] getEmptyList()
 * @method  \App\Models\File[]|\Traversable|array all($order = null, $direction = null)
 * @method  \App\Models\File[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method  \App\Models\File create($value)
 * @method  \App\Models\File find($id)
 * @method  \App\Models\File[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method  \App\Models\File[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method  \App\Models\File update($model, $input)
 * @method  \App\Models\File save($model);
 * @method  \App\Models\File firstByFilter($filter);
 * @method  \App\Models\File[]|\Traversable|array getByFilter($filter,$order = null, $direction = null, $offset = null, $limit = null);
 * @method  \App\Models\File[]|\Traversable|array allByFilter($filter,$order = null, $direction = null);
 */
interface FileRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\File
     */
    public function getBlankModel();
}
