<?php

namespace App\Http\Responses\Api\Admin;

class AdminUser extends Response
{
    protected $columns = [
        'id'           => '',
        'name'         => '',
        'profileImage' => null,
        'roles'        => [],
    ];

    /**
     * @param \App\Models\AdminUser $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $roles = [];
        foreach($model->adminUserRoles as $role) {
            $roles[] = AdminUserRole::updateWithModel($role)->toArray();
        }

        $response = new static([], 400);
        if(!empty($model)) {
            $modelArray = [
                'id'           => $model->id,
                'name'         => $model->name,
                'profileImage' => Image::updateWithModel($model->present()->profileImage),
                'roles'        => $roles,
            ];
            $response   = new static($modelArray, 200);
        }

        return $response;
    }
}
