<?php
namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\V1\Request;

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
            'email'         => 'required|email',
            'password'      => 'required|min:6',
            'client_id'     => 'required',
            'client_secret' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'         => trans('validation.required'),
            'email.email'            => trans('validation.email'),
            'password.required'      => trans('validation.required'),
            'password.min'           => trans('validation.min.string'),
            'client_id.required'     => trans('validation.required'),
            'client_secret.required' => trans('validation.required'),
        ];
    }
}
