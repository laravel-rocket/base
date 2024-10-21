<?php

namespace App\Http\Requests;

class ResetPasswordRequest extends Request
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
            'password_confirmation' => 'required',
            'token' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => trans('validation.required'),
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'password.required' => trans('validation.required'),
            'password.min' => trans('validation.min.string'),
            'password_confirmation.required' => trans('validation.required'),
        ];
    }
}
