<?php

namespace App\Services\Production;

use App\Repositories\AdminPasswordResetRepositoryInterface;
use App\Repositories\AdminUserRepositoryInterface;
use App\Services\AdminUserServiceInterface;
use LaravelRocket\Foundation\Services\Production\AuthenticatableService;

class AdminUserService extends AuthenticatableService implements AdminUserServiceInterface
{
    protected string $resetEmailTitle = 'Reset Password';

    protected string $resetEmailTemplate = 'emails.admin.reset_password';

    public function __construct(
        AdminUserRepositoryInterface $adminUserRepository,
        AdminPasswordResetRepositoryInterface $adminUserPasswordResetRepository
    ) {
        parent::__construct($adminUserRepository, $adminUserPasswordResetRepository);
        $this->authenticatableRepository = $adminUserRepository;
        $this->passwordResettableRepository = $adminUserPasswordResetRepository;
    }

    public function getGuardName(): string
    {
        return 'admins';
    }
}
