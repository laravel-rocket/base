<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\Admin\AdminUser\UpdateRequest;
use App\Http\Responses\Api\Admin\AdminUser;

use App\Repositories\AdminUserRepositoryInterface;
use App\Repositories\AdminUserRoleRepositoryInterface;
use App\Services\AdminUserServiceInterface;
use App\Services\FileServiceInterface;

class MeController extends Controller
{
    /** @var \App\Repositories\AdminUserRepositoryInterface */
    protected $adminUserRepository;

    /** @var \App\Services\AdminUserServiceInterface $adminUserService */
    protected $adminUserService;

    /** @var \App\Services\FileServiceInterface $fileService */
    protected $fileService;

    /** @var \App\Repositories\AdminUserRoleRepositoryInterface $adminUserRoleRepository */
    protected $adminUserRoleRepository;

    public function __construct(
        AdminUserRepositoryInterface $adminUserRepository,
        FileServiceInterface $fileService,
        AdminUserServiceInterface $adminUserService,
        AdminUserRoleRepositoryInterface $adminUserRoleRepository
    ) {
        $this->adminUserRepository     = $adminUserRepository;
        $this->adminUserService        = $adminUserService;
        $this->fileService             = $fileService;
        $this->adminUserRoleRepository = $adminUserRoleRepository;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        /** @var \App\Models\AdminUser $adminUser */
        $adminUser = $this->adminUserService->getUser();

        return AdminUser::updateWithModel($adminUser)->response();
    }

    /**
     * @param \App\Http\Requests\Api\Admin\AdminUser\UpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        $adminUser = $this->adminUserService->getUser();

        $input = $request->only([
            'name',
            'email',
            'password',
        ]);

        if ($request->hasFile('profile_image_id')) {
            $file      = $request->file('profile_image_id');
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileService->upload('profile-image', $path, $mediaType, []);
            if (!empty($image)) {
                if (!empty($adminUser->profileImage)) {
                    $this->fileService->delete($adminUser->profileImage);
                }
                $input['profile_image_id'] = $image->id;
            }
        }

        $adminUser = $this->adminUserRepository->update($adminUser, $input);

        return AdminUser::updateWithModel($adminUser)->response();
    }
}
