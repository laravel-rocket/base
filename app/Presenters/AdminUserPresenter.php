<?php
namespace App\Presenters;

use LaravelRocket\Foundation\Presenters\BasePresenter;

/**
 * @property  \App\Models\AdminUser $entity
 * @property  int $id
 * @property  string $name
 * @property  string $email
 * @property  string $password
 * @property  int $profile_image_id
 * @property  string $remember_token
 * @property  \Carbon\Carbon $created_at
 * @property  \Carbon\Carbon $updated_at
 */
class AdminUserPresenter extends BasePresenter
{
    protected $multilingualFields = [
    ];

    protected $imageFields = [
    'profile_image',
    ];

    public function profileImage()
    {
        $model = $this->entity->profileImage;
        if (!$model) {
            $model      = new \App\Models\File();
            $model->url = \URLHelper::asset('images/user.png', 'common');
        }

        return $model;
    }
}
