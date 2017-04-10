<?php
namespace App\Services\Production;

use App\Repositories\UserPasswordResetRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserServiceInterface;
use LaravelRocket\Foundation\Services\Production\AuthenticatableService;

class UserService extends AuthenticatableService implements UserServiceInterface
{
    /** @var string $resetEmailTitle */
    protected $resetEmailTitle = 'Reset Password';

    /** @var string $resetEmailTemplate */
    protected $resetEmailTemplate = 'emails.user.reset_password';

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordResetRepositoryInterface $userPasswordResetRepository
    ) {
        $this->authenticatableRepository    = $userRepository;
        $this->passwordResettableRepository = $userPasswordResetRepository;
    }

    public function getGuardName()
    {
        return 'web';
    }
}
