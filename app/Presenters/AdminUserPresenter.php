<?php

namespace App\Presenters;

use LaravelRocket\Foundation\Presenters\BasePresenter;

/**
 *
 * @property \App\Models\AdminUser $entity
 */

class AdminUserPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = ['profile_image'];
}
