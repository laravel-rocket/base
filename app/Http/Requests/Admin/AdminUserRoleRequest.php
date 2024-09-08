<?php
namespace App\Http\Requests\Admin;

use App\Repositories\AdminUserRoleRepositoryInterface;

class AdminUserRoleRequest extends Request
{
    protected AdminUserRoleRepositoryInterface $adminUserRoleRepository;

    public function __construct(AdminUserRoleRepositoryInterface $adminUserRoleRepository)
    {
        parent::__construct();
        $this->adminUserRoleRepository = $adminUserRoleRepository;
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
        return $this->adminUserRoleRepository->rules();
    }

    public function messages(): array
    {
        return $this->adminUserRoleRepository->messages();
    }
}
