<?php
namespace App\Services\Production;

use App\Repositories\UserPasswordResetRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\FileServiceInterface;
use App\Services\UserServiceInterface;
use LaravelRocket\Foundation\Services\Production\AuthenticatableService;

class UserService extends AuthenticatableService implements UserServiceInterface
{
    /** @var string $resetEmailTitle */
    protected $resetEmailTitle = 'Reset Password';

    /** @var string $resetEmailTemplate */
    protected $resetEmailTemplate = 'emails.user.reset_password';

    /** @var FileServiceInterface $fileService */
    protected $fileService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordResetRepositoryInterface $userPasswordResetRepository,
        FileServiceInterface $fileService
    ) {
        $this->authenticatableRepository    = $userRepository;
        $this->passwordResettableRepository = $userPasswordResetRepository;
        $this->fileService                  = $fileService;
    }

    public function getGuardName()
    {
        return 'web';
    }

    public function createWithImageUrl($input, $imageUrl)
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
