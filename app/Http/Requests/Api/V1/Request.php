<?php
namespace App\Http\Requests\Api\V1;

use App\Exceptions\Api\V1\APIErrorException;
use App\Http\Requests\Request as BaseRequest;
use Illuminate\Contracts\Validation\Validator;

class Request extends BaseRequest
{
    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @throws \App\Exceptions\Api\V1\APIErrorException
     */
    protected function failedValidation(Validator $validator)
    {
        $transformed = [];

        foreach ($validator->errors() as $field => $message) {
            $transformed[] = [
                'name'    => $field,
                'message' => $message[0],
            ];
        }
        throw new APIErrorException('wrongParameter', 'Wrong Parameters', ['invalidParams' => $transformed]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }

    public function onlyNonNull($keys)
    {
        $data   = parent::only($keys);
        $result = [];
        foreach ($data as $key => $value) {
            if (!is_null($value)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
