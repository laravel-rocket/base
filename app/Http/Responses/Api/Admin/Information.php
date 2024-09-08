<?php
namespace App\Http\Responses\Api\Admin;

class Information extends Response
{
    protected array $columns = [
        'authUser'          => null,
        'notifications'     => [],
        'notificationCount' => 0,
    ];

    public static function updateWithData(?\App\Models\AdminUser $authUser, array $notifications): static
    {
        $response = new static([], 400);
        if (!empty($authUser)) {
            $modelArray = [
                'authUser'          => AdminUser::updateWithModel($authUser),
                'notifications'     => $notifications,
                'notificationCount' => 0,
            ];
            $response   = new static($modelArray, 200);
        }

        return $response;
    }
}
