<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Repositories\UserRepositoryInterface;
use LaravelRocket\Foundation\Http\Requests\PaginationRequest;

class UserController extends Controller
{
    /** @var \App\Repositories\UserRepositoryInterface */
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
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
        $offset = $request->offset();
        $limit  = $request->limit();
        $count  = $this->userRepository->count();
        $users  = $this->userRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.users.index', [
            'users'   => $users,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\UserController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('pages.admin.users.edit', [
            'isNew' => true,
            'user'  => $this->userRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $input = $request->only(['name', 'email', 'password']);

        $user = $this->userRepository->create($input);

        if (empty($user)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\UserController@index')->with(
            'message-success',
            trans('admin.messages.general.create_success')
        );
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
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            abort(404);
        }

        return view('pages.admin.users.edit', [
            'isNew' => false,
            'user'  => $user,
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
        return redirect()->action('Admin\UserController@show', [$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param     $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function update($id, UserRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            abort(404);
        }
        $input = $request->only(['name', 'email', 'password']);

        $this->userRepository->update($user, $input);

        return redirect()->action('Admin\UserController@show', [$id])->with(
            'message-success',
            trans('admin.messages.general.update_success')
        );
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
        /** @var \App\Models\User $user */
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            abort(404);
        }
        $this->userRepository->delete($user);

        return redirect()->action('Admin\UserController@index')->with(
            'message-success',
            trans('admin.messages.general.delete_success')
        );
    }
}
