<?php
namespace App\Http\Requests;

use LaravelRocket\Foundation\Http\Requests\Request;

class SignInRequest extends Request
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
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => trans('validation.required'),
            'email.email'       => trans('validation.email'),
            'password.required' => trans('validation.required'),
            'password.min'      => trans('validation.min', ['min' => 6]),
        ];
    }
}
