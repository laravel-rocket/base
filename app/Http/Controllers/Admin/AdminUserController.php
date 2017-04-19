<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Repositories\AdminUserRepositoryInterface;
use App\Services\FileServiceInterface;
use LaravelRocket\Foundation\Http\Requests\PaginationRequest;

class AdminUserController extends Controller
{
    /** @var \App\Repositories\AdminUserRepositoryInterface */
    protected $adminUserRepository;

    /** @var FileServiceInterface $fileService */
    protected $fileService;

    public function __construct(
        AdminUserRepositoryInterface $adminUserRepository,
        FileServiceInterface $fileService
    ) {
        $this->adminUserRepository = $adminUserRepository;
        $this->fileService         = $fileService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \LaravelRocket\Foundation\Http\Requests\PaginationRequest $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function index(PaginationRequest $request)
    {
        $offset     = $request->offset();
        $limit      = $request->limit();
        $count      = $this->adminUserRepository->count();
        $adminUsers = $this->adminUserRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.admin-users.index', [
            'adminUsers' => $adminUsers,
            'count'      => $count,
            'offset'     => $offset,
            'limit'      => $limit,
            'baseUrl'    => action('Admin\AdminUserController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('pages.admin.admin-users.edit', [
            'isNew'     => true,
            'adminUser' => $this->adminUserRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function store(AdminUserRequest $request)
    {
        $input = $request->only(['name', 'email', 'password']);

        $adminUser = $this->adminUserRepository->create($input);

        if (empty($adminUser)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        if ($request->hasFile('profile_image')) {
            $image = $adminUser->profileImage;
            if (!empty($image)) {
                $this->fileService->delete($image);
            }

            $file      = $request->file('profile_image');
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileService->upload('profile-image', $path, $mediaType, []);
            $this->adminUserRepository->update($adminUser, ['profile_image_id' => $image->id]);
        }

        return redirect()->action('Admin\AdminUserController@index')
            ->with('message-success', trans('admin.messages.general.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $adminUser = $this->adminUserRepository->find($id);
        if (empty($adminUser)) {
            abort(404);
        }

        return view('pages.admin.admin-users.edit', [
            'isNew'     => false,
            'adminUser' => $adminUser,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        return redirect()->action('Admin\AdminUserController@show', [$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param     $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function update($id, AdminUserRequest $request)
    {
        /** @var \App\Models\AdminUser $adminUser */
        $adminUser = $this->adminUserRepository->find($id);
        if (empty($adminUser)) {
            abort(404);
        }
        $input = $request->only(['name', 'email', 'password']);

        if ($request->hasFile('profile_image')) {
            $image = $adminUser->profileImage;
            if (!empty($image)) {
                $this->fileService->delete($image);
            }

            $file                      = $request->file('profile_image');
            $mediaType                 = $file->getClientMimeType();
            $path                      = $file->getPathname();
            $image                     = $this->fileService->upload('profile-image', $path, $mediaType, []);
            $input['profile_image_id'] = $image->id;
        }

        $this->adminUserRepository->update($adminUser, $input);

        return redirect()->action('Admin\AdminUserController@show', [$id])
            ->with('message-success', trans('admin.messages.general.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        /** @var \App\Models\AdminUser $adminUser */
        $adminUser = $this->adminUserRepository->find($id);
        if (empty($adminUser)) {
            abort(404);
        }
        $this->adminUserRepository->delete($adminUser);

        return redirect()->action('Admin\AdminUserController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
