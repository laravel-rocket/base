<?php

namespace App\Http\Requests\Api\Admin\AdminUser;

use App\Http\Requests\Api\Admin\Request;

class ShowRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }
}
