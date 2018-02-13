<?php
namespace App\Presenters;

use LaravelRocket\Foundation\Presenters\BasePresenter;

/**
 * @property  \App\Models\AdminUserRole $entity
 * @property  int $id
 * @property  int $admin_user_id
 * @property  string $role
 * @property  \Carbon\Carbon $created_at
 * @property  \Carbon\Carbon $updated_at
 */
class AdminUserRolePresenter extends BasePresenter
{
    protected $multilingualFields = [
    ];

    protected $imageFields = [
    ];

    public function adminUser()
    {
        $model = $this->entity->adminUser;
        if (!$model) {
            $model      = new \App\Models\AdminUser();
        }

        return $model;
    }

    public function role()
    {
        return trans('tables/admin-user-roles/columns.role_options.'.$this->entity->role);
    }
}
