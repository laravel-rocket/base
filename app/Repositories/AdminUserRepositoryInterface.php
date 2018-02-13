<?php
namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;

/**
 * @method  \App\Models\AdminUser[] getEmptyList()
 * @method  \App\Models\AdminUser[]|\Traversable|array all($order = null, $direction = null)
 * @method  \App\Models\AdminUser[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method  \App\Models\AdminUser create($value)
 * @method  \App\Models\AdminUser find($id)
 * @method  \App\Models\AdminUser[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method  \App\Models\AdminUser[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method  \App\Models\AdminUser update($model, $input)
 * @method  \App\Models\AdminUser save($model);
 * @method  \App\Models\AdminUser firstByFilter($filter);
 * @method  \App\Models\AdminUser[]|\Traversable|array getByFilter($filter,$order = null, $direction = null, $offset = null, $limit = null);
 * @method  \App\Models\AdminUser[]|\Traversable|array allByFilter($filter,$order = null, $direction = null);
 */
interface AdminUserRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\AdminUser
     */
    public function getBlankModel();
}
