<?php

namespace App\Http\Requests\JwtAuth;

use App\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'mobile' => '',
            'user_name' => 'required',
            'personnel_code' => 'required',
            'password' => 'required|min:6',
            'c_password' => 'required|min:6|same:password',
        ];
    }
}
 