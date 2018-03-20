<?php
namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\Api\Admin\APIErrorException;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\AdminUserRequest;
use App\Http\Requests\Api\Admin\AdminUser\IndexRequest;
use App\Http\Requests\Api\Admin\AdminUser\UpdateRequest;
use App\Http\Responses\Api\Admin\AdminUser;
use App\Http\Responses\Api\Admin\AdminUsers;
use App\Http\Responses\Api\Admin\Status;

use App\Repositories\AdminUserRepositoryInterface;
use App\Repositories\AdminUserRoleRepositoryInterface;
use App\Services\AdminUserServiceInterface;
use App\Services\FileServiceInterface;

class AdminUserController extends Controller
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
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request)
    {
        $offset    = $request->offset();
        $limit     = $request->limit();
        $order     = $request->order();
        $direction = $request->direction();

        $queryWord = $request->get('query');
        $filter    = [];
        if (!empty($queryWord)) {
            $filter['query'] = $queryWord;
        }

        $count      = $this->adminUserRepository->count();
        $adminUsers = $this->adminUserRepository->getByFilter($filter, $order, $direction, $offset, $limit);

        return AdminUsers::updateListWithModel($adminUsers, $offset, $limit, $count)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   $request
     *
     * @throws APIErrorException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AdminUserRequest $request)
    {
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
                $input['profile_image_id'] = $image->id;
            }
        }

        $adminUser = $this->adminUserRepository->create($input);

        if (empty($adminUser)) {
            throw new APIErrorException('unknown', 'AdminUser Creation Failed');
        }

        $roles = $request->get('roles', []);
        $this->adminUserRoleRepository->updateMultipleEntries($adminUser->id, 'admin_user_id', 'role', $roles);

        return AdminUser::updateWithModel($adminUser)->response();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @throws APIErrorException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $adminUser = $this->adminUserRepository->find($id);
        if (empty($adminUser)) {
            throw new APIErrorException('notFound', 'AdminUser not found');
        }

        return AdminUser::updateWithModel($adminUser)->response();
    }

    /**
     * @param int                                                  $id
     * @param \App\Http\Requests\Api\Admin\AdminUser\UpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \App\Exceptions\Api\Admin\APIErrorException
     */
    public function update($id, UpdateRequest $request)
    {
        $adminUser = $this->adminUserRepository->find($id);
        if (empty($adminUser)) {
            throw new APIErrorException('notFound', 'AdminUser not found');
        }

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

        $roles = $request->get('roles', []);
        $this->adminUserRoleRepository->updateMultipleEntries($adminUser->id, 'admin_user_id', 'role', $roles);

        return AdminUser::updateWithModel($adminUser)->response();
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \App\Exceptions\Api\Admin\APIErrorException
     */
    public function destroy($id)
    {
        $adminUser = $this->adminUserRepository->find($id);
        if (empty($adminUser)) {
            throw new APIErrorException('notFound', 'AdminUser not found');
        }

        $this->adminUserRepository->delete($adminUser);

        return Status::ok()->response();
    }
}
