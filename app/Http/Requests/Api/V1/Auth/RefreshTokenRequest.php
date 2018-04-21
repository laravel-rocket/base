<?php
namespace App\Http\Requests\API\V1\Auth;

use App\Http\Requests\Api\V1\Request;

class RefreshTokenRequest extends Request
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
            'refresh_token' => 'required',
            'grant_type'    => 'required',
            'client_id'     => 'required',
            'client_secret' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'refresh_token.required' => config('api.validateErrors.required'),
            'grant_type.required'    => config('api.validateErrors.required'),
            'client_id.required'     => config('api.validateErrors.required'),
            'client_secret.required' => config('api.validateErrors.required'),
        ];
    }
}
