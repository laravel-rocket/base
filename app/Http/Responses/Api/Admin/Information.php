<?php
namespace App\Http\Responses\Api\Admin;

class Information extends Response
{
    protected $columns = [
        'authUser'          => null,
        'notifications'     => [],
        'notificationCount' => 0,
    ];

    /**
     * @param \App\Models\AdminUser $authUser
     * @param array                 $notifications
     *
     * @return static
     */
    public static function updateWithData($authUser, $notifications)
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
