<?php

namespace App\Http\Requests\Api\Admin\AdminUser;

use App\Http\Requests\Api\Admin\PaginationRequest;

class IndexRequest extends PaginationRequest
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
