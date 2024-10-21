<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\PasswordController as PasswordControllerBase;
use App\Services\AdminUserServiceInterface;

class PasswordController extends PasswordControllerBase
{
    protected string $emailSetPageView = 'pages.admin.auth.forgot-password';

    protected string $passwordResetPageView = 'pages.admin.auth.reset-password';

    protected string $returnAction = 'Admin\IndexController@index';

    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        parent::__construct($adminUserService);
    }
}
