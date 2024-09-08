<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\PasswordController as PasswordControllerBase;
use App\Services\AdminUserServiceInterface;

class PasswordController extends PasswordControllerBase
{
    /** @var string $emailSetPageView */
    protected string $emailSetPageView = 'pages.admin.auth.forgot-password';

    /** @var string $passwordResetPageView */
    protected string $passwordResetPageView = 'pages.admin.auth.reset-password';

    /** @var string $returnAction */
    protected string $returnAction = 'Admin\IndexController@index';

    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        parent::__construct($adminUserService);
    }
}
