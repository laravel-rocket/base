<?php
namespace App\Repositories;

use LaravelRocket\Foundation\Repositories\SingleKeyModelRepositoryInterface;

/**
 * @method  \App\Models\AdminUserRole[] getEmptyList()
 * @method  \App\Models\AdminUserRole[]|\Traversable|array all($order = null, $direction = null)
 * @method  \App\Models\AdminUserRole[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method  \App\Models\AdminUserRole create($value)
 * @method  \App\Models\AdminUserRole find($id)
 * @method  \App\Models\AdminUserRole[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method  \App\Models\AdminUserRole[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method  \App\Models\AdminUserRole update($model, $input)
 * @method  \App\Models\AdminUserRole save($model);
 * @method  \App\Models\AdminUserRole firstByFilter($filter);
 * @method  \App\Models\AdminUserRole[]|\Traversable|array getByFilter($filter,$order = null, $direction = null, $offset = null, $limit = null);
 * @method  \App\Models\AdminUserRole[]|\Traversable|array allByFilter($filter,$order = null, $direction = null);
 */
interface AdminUserRoleRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @return \App\Models\AdminUserRole
     */
    public function getBlankModel();
}
