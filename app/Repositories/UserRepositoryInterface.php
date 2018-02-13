<?php
namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;

/**
 * @method  \App\Models\User[] getEmptyList()
 * @method  \App\Models\User[]|\Traversable|array all($order = null, $direction = null)
 * @method  \App\Models\User[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method  \App\Models\User create($value)
 * @method  \App\Models\User find($id)
 * @method  \App\Models\User[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method  \App\Models\User[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method  \App\Models\User update($model, $input)
 * @method  \App\Models\User save($model);
 * @method  \App\Models\User firstByFilter($filter);
 * @method  \App\Models\User[]|\Traversable|array getByFilter($filter,$order = null, $direction = null, $offset = null, $limit = null);
 * @method  \App\Models\User[]|\Traversable|array allByFilter($filter,$order = null, $direction = null);
 */
interface UserRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\User
     */
    public function getBlankModel();
}
