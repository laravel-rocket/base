<?php
namespace App\Services\Production;

use App\Repositories\AdminPasswordResetRepositoryInterface;
use App\Repositories\AdminUserRepositoryInterface;
use App\Services\AdminUserServiceInterface;
use LaravelRocket\Foundation\Services\Production\AuthenticatableService;

class AdminUserService extends AuthenticatableService implements AdminUserServiceInterface
{
    /** @var string $resetEmailTitle */
    protected $resetEmailTitle = 'Reset Password';

    /** @var string $resetEmailTemplate */
    protected $resetEmailTemplate = 'emails.admin.reset_password';

    public function __construct(
        AdminUserRepositoryInterface $adminUserRepository,
        AdminPasswordResetRepositoryInterface $adminUserPasswordResetRepository
    ) {
        $this->authenticatableRepository    = $adminUserRepository;
        $this->passwordResettableRepository = $adminUserPasswordResetRepository;
    }

    public function getGuardName()
    {
        return 'admins';
    }
}
