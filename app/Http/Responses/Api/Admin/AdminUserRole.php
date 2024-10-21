<?php

namespace App\Http\Responses\Api\Admin;

class AdminUserRole extends Response
{
    protected array $columns = [
        'name' => '',
        'role' => '',
    ];

    /**
     * @param  \App\Models\AdminUserRole  $model
     */
    public static function updateWithModel($model): static
    {
        $response = new static([], 400);
        if (! empty($model)) {
            $modelArray = [
                'name' => $model->present()->role,
                'role' => $model->role,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
