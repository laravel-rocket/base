<?php
namespace App\Presenters;

use App\Models\File;
use LaravelRocket\Foundation\Presenters\BasePresenter;

/**
 * @property \App\Models\User $entity
 */
class UserPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = ['profile_image'];

    public function profileImage()
    {
        $image = $this->entity->profileImage;
        if (!$image) {
            $image = new File();
            $image->url = \URLHelper::asset('img/user.png', 'common');
        }

        return $image;
    }
}
