<?php

namespace App\Http\Requests;

class SignInRequest extends Request
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
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'password.required' => trans('validation.required'),
            'password.min' => trans('validation.min.string', ['min' => 6]),
        ];
    }
}
