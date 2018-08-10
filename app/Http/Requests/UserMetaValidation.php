<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\APIResponse;

class UserMetaValidation extends FormRequest
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
            'meta_key'  => 'required',
            'user_id'   => 'required|exists:users,id',
        ];
    }

    public function failedValidation(Validator $validator) {
        $this->sendAPIValidationError('validation error',$validator->errors());
    }
}
