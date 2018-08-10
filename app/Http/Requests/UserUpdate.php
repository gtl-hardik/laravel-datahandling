<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\APIResponse;

class UserUpdate extends FormRequest
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

    use CommonRules,APIResponse;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'key_name'    => 'required',
            'key_value'   => 'required',
        ];
    }

    public function failedValidation(Validator $validator) {
        $this->sendAPIValidationError('validation error',$validator->errors());
    }
}
