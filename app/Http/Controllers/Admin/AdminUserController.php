<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\AdminUserRequest;
use App\Models\AdminUser;
use App\Repositories\AdminUserRepositoryInterface;
use LaravelRocket\Foundation\Http\Requests\PaginationRequest;

class AdminUserController extends Controller
{
    /** @var \App\Repositories\AdminUserRepositoryInterface */
    protected $adminUserRepository;

    public function __construct(
        AdminUserRepositoryInterface $adminUserRepository
    ) {
        $this->adminUserRepository = $adminUserRepository;
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
            'models'  => $adminUsers,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\AdminUserController@index'),
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
     * @param   $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function store(AdminUserRequest $request)
    {
        $input = $request->only([
            'name',
            'email',
            'password',
            'profile_image_id',
        ]);

        $adminUser = $this->adminUserRepository->create($input);

        if (empty($adminUser)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
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
        $adminUser = $this->adminUserRepository->find($id);
        if (empty($adminUser)) {
            abort(404);
        }

        $input = $request->only([
            'name',
            'email',
            'password',
            'profile_image_id',
        ]);
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
        $adminUser = $this->adminUserRepository->find($id);
        if (empty($adminUser)) {
            abort(404);
        }
        $this->adminUserRepository->delete($adminUser);

        return redirect()->action('Admin\AdminUserController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
