<?php
namespace App\Http\Requests\Admin;

use App\Repositories\UserRepositoryInterface;

class UserRequest extends Request
{
    /** @var \App\Repositories\UserRepositoryInterface */
    protected $userRepository;

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
        return $this->userRepository->rules();
    }

    public function messages()
    {
        return $this->userRepository->messages();
    }
}
