<?php
namespace App\Http\Requests\Admin;

use App\Repositories\FileRepositoryInterface;

class FileRequest extends Request
{
    /** @var \App\Repositories\FileRepositoryInterface */
    protected $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        parent::__construct();
        $this->fileRepository = $fileRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->fileRepository->rules();
    }

    public function messages()
    {
        return $this->fileRepository->messages();
    }
}
