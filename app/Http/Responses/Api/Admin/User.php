<?php
namespace App\Http\Responses\Api\Admin;

class User extends Response
{
    protected $columns = [
        'id'           => 0,
        'name'         => '',
        'email'        => '',
        'createdAt'    => null,
        'updatedAt'    => null,
        'profileImage' => null,
    ];

    /**
     * @param \App\Models\User $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'           => $model->id,
                'name'         => $model->name,
                'email'        => $model->email,
                'createdAt'    => $model->created_at ? $model->created_at->timestamp : null,
                'updatedAt'    => $model->updated_at ? $model->updated_at->timestamp : null,
                'profileImage' => Image::updateWithModel($model->profileImage),
            ];
            $response   = new static($modelArray, 200);
        }

        return $response;
    }
}
