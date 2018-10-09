<?php
namespace App\Http\Requests\Api\Admin;

use App\Exceptions\Api\Admin\APIErrorException;
use Illuminate\Contracts\Validation\Validator;
use LaravelRocket\Foundation\Http\Requests\APIRequest as BaseRequest;

class Request extends BaseRequest
{
    protected function failedValidation(Validator $validator)
    {
        $transformed = [];

        $validateErrors = $validator->getMessageBag();
        foreach ($validateErrors->getMessages() as $field => $message) {
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
