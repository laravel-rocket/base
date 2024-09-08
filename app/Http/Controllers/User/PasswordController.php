<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\PasswordController as PasswordControllerBase;
use App\Services\UserServiceInterface;

class PasswordController extends PasswordControllerBase
{
    /** @var string $emailSetPageView */
    protected string $emailSetPageView = 'pages.user.auth.forgot-password';

    /** @var string $passwordResetPageView */
    protected string $passwordResetPageView = 'pages.user.auth.reset-password';

    /** @var string $returnAction */
    protected string $returnAction = 'User\IndexController@index';

    public function __construct(UserServiceInterface $userService)
    {
        parent::__construct($userService);
    }
}
