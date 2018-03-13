<?php
namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\Api\Admin\APIErrorException;
use App\Http\Controllers\Controller;

use App\Http\Requests\Api\Admin\User\IndexRequest;
use App\Http\Requests\Api\Admin\User\StoreRequest;
use App\Http\Requests\Api\Admin\User\UpdateRequest;
use App\Http\Responses\Api\Admin\Status;
use App\Http\Responses\Api\Admin\User;
use App\Http\Responses\Api\Admin\Users;
use App\Repositories\UserRepositoryInterface;
use App\Services\AdminUserServiceInterface;
use App\Services\FileServiceInterface;

class UserController extends Controller
{
    /** @var \App\Repositories\UserRepositoryInterface */
    protected $userRepository;

    /** @var \App\Services\AdminUserServiceInterface $adminUserServicee */
    protected $adminUserService;

    /** @var \App\Services\FileServiceInterface $fileService */
    protected $fileService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        FileServiceInterface $fileService,
        AdminUserServiceInterface $adminUserService
    ) {
        $this->userRepository      = $userRepository;
        $this->adminUserService    = $adminUserService;
        $this->fileService         = $fileService;
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

        $count      = $this->userRepository->count();
        $users      = $this->userRepository->getByFilter($filter, $order, $direction, $offset, $limit);

        return Users::updateListWithModel($users, $offset, $limit, $count)->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @throws APIErrorException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only([
            'name',
            'email',
            'password',
        ]);

        if ($request->hasFile('profile_image')) {
            $file          = $request->file('profile_image');
            $mediaType     = $file->getClientMimeType();
            $path          = $file->getPathname();
            $fileModel     = $this->fileService->upload('default-image', $path, $mediaType, []);
            if (!empty($fileModel)) {
                $input['profile_image_id'] = $fileModel->id;
            }
        }

        $user = $this->userRepository->create($input);

        if (empty($user)) {
            throw new APIErrorException('unknown', 'User Creation Failed');
        }

        return User::updateWithModel($user)->withStatus(201)->response();
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
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            throw new APIErrorException('notFound', 'User not found');
        }

        return User::updateWithModel($user)->response();
    }

    /**
     * @param int           $id
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \App\Exceptions\Api\Admin\APIErrorException
     */
    public function update($id, UpdateRequest $request)
    {
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            throw new APIErrorException('notFound', 'User not found');
        }

        $input = $request->only([
        'name',
        'email',
        'password',
        ]);

        if ($request->hasFile('profile_image')) {
            $file          = $request->file('profile_image');
            $mediaType     = $file->getClientMimeType();
            $path          = $file->getPathname();
            $fileModel     = $this->fileService->upload('default-image', $path, $mediaType, []);
            if (!empty($fileModel)) {
                if (!empty($user->profileImage)) {
                    $this->fileService->delete($user->profileImage);
                }
                $input['profile_image_id'] = $fileModel->id;
            }
        }

        $user = $this->userRepository->update($user, $input);

        return User::updateWithModel($user)->response();
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
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            throw new APIErrorException('notFound', 'User not found');
        }

        $this->userRepository->delete($user);

        return Status::ok()->response();
    }
}
