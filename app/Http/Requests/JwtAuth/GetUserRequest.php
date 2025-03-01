<?php

namespace App\Http\Requests\JwtAuth;

use App\Http\Requests\BaseFormRequest;

class GetUserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required'
        ];
    }
}
