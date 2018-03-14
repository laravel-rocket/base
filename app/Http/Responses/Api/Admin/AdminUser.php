<?php
namespace App\Http\Responses\Api\Admin;

class AdminUser extends Response
{
    protected $columns = [
        'id'           => '',
        'name'         => '',
        'profileImage' => null,
        'email'        => '',
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
        foreach ($model->adminUserRoles as $role) {
            $roles[] = $role->role;
        }

        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'           => $model->id,
                'name'         => $model->name,
                'profileImage' => Image::updateWithModel($model->present()->profileImage),
                'email'        => $model->email,
                'roles'        => $roles,
            ];
            $response   = new static($modelArray, 200);
        }

        return $response;
    }
}
