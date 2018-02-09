<?php
namespace App\Http\Requests;

class SignUpRequest extends Request
{
    /*
     * Redirect action when validate fail
     * */
    protected $redirectAction = 'User\AuthController@getSignUp';

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
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => trans('validation.required'),
            'email.email'       => trans('validation.email'),
            'password.required' => trans('validation.required'),
            'password.min'      => trans('validation.min.string', ['min' => 6]),
        ];
    }
}
