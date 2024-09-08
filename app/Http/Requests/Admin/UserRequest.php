<?php
namespace App\Http\Requests\Admin;

use App\Repositories\UserRepositoryInterface;

class UserRequest extends Request
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
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
        return $this->userRepository->rules();
    }

    public function messages(): array
    {
        return $this->userRepository->messages();
    }
}
