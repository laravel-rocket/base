<?php
namespace App\Http\Requests;

class ResetPasswordRequest extends Request
{
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
        return [
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required',
            'token'                 => 'required',
        ];
    }

    public function messages()
    {
        return [
            'token.required'                 => trans('validation.required'),
            'email.required'                 => trans('validation.required'),
            'email.email'                    => trans('validation.email'),
            'password.required'              => trans('validation.required'),
            'password.min'                   => trans('validation.min.string'),
            'password_confirmation.required' => trans('validation.required'),
        ];
    }
}
