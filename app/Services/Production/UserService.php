<?php
namespace App\Services\Production;

use App\Repositories\UserPasswordResetRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\FileServiceInterface;
use App\Services\UserServiceInterface;
use LaravelRocket\Foundation\Models\AuthenticatableBase;
use LaravelRocket\Foundation\Models\Base;
use LaravelRocket\Foundation\Services\Production\AuthenticatableService;

class UserService extends AuthenticatableService implements UserServiceInterface
{
    protected string $resetEmailTitle = 'Reset Password';

    protected string $resetEmailTemplate = 'emails.user.reset_password';

    protected FileServiceInterface $fileService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordResetRepositoryInterface $userPasswordResetRepository,
        FileServiceInterface $fileService
    ) {
        parent::__construct($userRepository, $userPasswordResetRepository);
        $this->authenticatableRepository    = $userRepository;
        $this->passwordResettableRepository = $userPasswordResetRepository;
        $this->fileService                  = $fileService;
    }

    public function getGuardName(): string
    {
        return 'web';
    }

    public function createWithImageUrl(array $input, string $imageUrl): AuthenticatableBase
    {
        if (!empty($imageUrl)) {
            $image = $this->fileService->createFromUrl('profile-image', $imageUrl, 'image/jpeg', []);
            if (!empty($image)) {
                $input['profile_image_id'] = $image->id;
            }
        }

        return parent::createWithImageUrl($input, $imageUrl);
    }
}
