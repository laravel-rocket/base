<?php
namespace App\Http\Responses\Api\V1;

class User extends Response
{
    protected $columns = [
        'id'           => '',
        'name'         => '',
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
                'profileImage' => empty($model->profileImage) ? null : Image::updateWithModel($model->profileImage),
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
