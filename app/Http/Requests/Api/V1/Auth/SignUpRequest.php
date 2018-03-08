<?php
namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Requests\Api\V1\Request;

class SignUpRequest extends Request
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
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
            'name'          => 'required',
            'gender'        => 'required|in:male,female',
            'client_id'     => 'required',
            'client_secret' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'         => trans('validation.required'),
            'email.email'            => trans('validation.email'),
            'email.unique'           => trans('validation.unique'),
            'password.required'      => trans('validation.required'),
            'name.required'          => trans('validation.required'),
            'client_id.required'     => trans('validation.required'),
            'client_secret.required' => trans('validation.required'),
            'gender.required'        => trans('validation.required'),
            'gender.in'              => trans('validation.in'),
        ];
    }
}
