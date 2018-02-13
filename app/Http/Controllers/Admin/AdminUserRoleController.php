<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\AdminUserRoleRequest;
use App\Models\AdminUserRole;
use App\Repositories\AdminUserRoleRepositoryInterface;
use LaravelRocket\Foundation\Http\Requests\PaginationRequest;

class AdminUserRoleController extends Controller
{
    /** @var \App\Repositories\AdminUserRoleRepositoryInterface */
    protected $adminUserRoleRepository;

    public function __construct(
        AdminUserRoleRepositoryInterface $adminUserRoleRepository
    ) {
        $this->adminUserRoleRepository = $adminUserRoleRepository;
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
        $offset         = $request->offset();
        $limit          = $request->limit();
        $count          = $this->adminUserRoleRepository->count();
        $adminUserRoles = $this->adminUserRoleRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.admin-user-roles.index', [
            'models'  => $adminUserRoles,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\AdminUserRoleController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('pages.admin.admin-user-roles.edit', [
            'isNew'         => true,
            'adminUserRole' => $this->adminUserRoleRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function store(AdminUserRoleRequest $request)
    {
        $input = $request->only([
            'admin_user_id',
            'role',
        ]);

        $adminUserRole = $this->adminUserRoleRepository->create($input);

        if (empty($adminUserRole)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AdminUserRoleController@index')
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
        $adminUserRole = $this->adminUserRoleRepository->find($id);
        if (empty($adminUserRole)) {
            abort(404);
        }

        return view('pages.admin.admin-user-roles.edit', [
            'isNew'         => false,
            'adminUserRole' => $adminUserRole,
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
        return redirect()->action('Admin\AdminUserRoleController@show', [$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param     $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function update($id, AdminUserRoleRequest $request)
    {
        $adminUserRole = $this->adminUserRoleRepository->find($id);
        if (empty($adminUserRole)) {
            abort(404);
        }

        $input = $request->only([
            'admin_user_id',
            'role',
        ]);
        $this->adminUserRoleRepository->update($adminUserRole, $input);

        return redirect()->action('Admin\AdminUserRoleController@show', [$id])
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
        $adminUserRole = $this->adminUserRoleRepository->find($id);
        if (empty($adminUserRole)) {
            abort(404);
        }
        $this->adminUserRoleRepository->delete($adminUserRole);

        return redirect()->action('Admin\AdminUserRoleController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
