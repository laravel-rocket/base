<?php
namespace App\Http\Requests\Admin;

use App\Repositories\FileRepositoryInterface;

class FileRequest extends Request
{
    protected FileRepositoryInterface $fileRepository;

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
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->fileRepository->rules();
    }

    public function messages(): array
    {
        return $this->fileRepository->messages();
    }
}
