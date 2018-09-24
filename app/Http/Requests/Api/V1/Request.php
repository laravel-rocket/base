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

        $errors = $validator->errors();

        foreach ($errors->keys() as $key) {
            $transformed[] = [
                'name'    => $key,
                'message' => $errors->get($key, [])[0],
            ];
        }

        $exception = new \App\Exceptions\Api\V1\APIErrorException('wrongParameter', 'Wrong Parameters', ['invalidParams' => $transformed]);

        throw $exception;
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
