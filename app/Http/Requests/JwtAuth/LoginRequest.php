<?php

namespace App\Http\Requests\JwtAuth;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'personnel_code' => 'required',
            'password' => 'required|string|min:6',
        ];
    }
}
