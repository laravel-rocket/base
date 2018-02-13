<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\FileRequest;
use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use LaravelRocket\Foundation\Http\Requests\PaginationRequest;

class FileController extends Controller
{
    /** @var \App\Repositories\FileRepositoryInterface */
    protected $fileRepository;

    public function __construct(
        FileRepositoryInterface $fileRepository
    ) {
        $this->fileRepository = $fileRepository;
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
        $count  = $this->fileRepository->count();
        $files  = $this->fileRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.files.index', [
            'models'  => $files,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\FileController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('pages.admin.files.edit', [
            'isNew'     => true,
            'file'      => $this->fileRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function store(FileRequest $request)
    {
        $input = $request->only([
            'url',
            'title',
            'entity_type',
            'entity_id',
            'storage_type',
            'file_category_type',
            'file_type',
            's3_key',
            's3_bucket',
            's3_region',
            's3_extension',
            'media_type',
            'format',
            'original_file_name',
            'file_size',
            'width',
            'height',
            'thumbnails',
            'is_enabled',
        ]);

        $file = $this->fileRepository->create($input);

        if (empty($file)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\FileController@index')
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
        $file = $this->fileRepository->find($id);
        if (empty($file)) {
            abort(404);
        }

        return view('pages.admin.files.edit', [
            'isNew' => false,
            'file'  => $file,
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
        return redirect()->action('Admin\FileController@show', [$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param     $request
     *
     * @return \Response|\Illuminate\Http\RedirectResponse
     */
    public function update($id, FileRequest $request)
    {
        $file = $this->fileRepository->find($id);
        if (empty($file)) {
            abort(404);
        }

        $input = $request->only([
            'url',
            'title',
            'entity_type',
            'entity_id',
            'storage_type',
            'file_category_type',
            'file_type',
            's3_key',
            's3_bucket',
            's3_region',
            's3_extension',
            'media_type',
            'format',
            'original_file_name',
            'file_size',
            'width',
            'height',
            'thumbnails',
            'is_enabled',
        ]);
        $this->fileRepository->update($file, $input);

        return redirect()->action('Admin\FileController@show', [$id])
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
        $file = $this->fileRepository->find($id);
        if (empty($file)) {
            abort(404);
        }
        $this->fileRepository->delete($file);

        return redirect()->action('Admin\FileController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
