<?php

namespace App\Http\Requests\Admin;

class MeUpdateRequest extends Request
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
            'email' => 'required|email',
            'password' => 'min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => trans('admin.errors.requests.me.email.required'),
            'email.email' => trans('admin.errors.requests.me.email.email'),
            'password.min' => trans('admin.errors.requests.me.password.min'),
        ];
    }
}
