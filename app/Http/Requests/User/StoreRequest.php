<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class StoreRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => '',
            'last_name' => '',
            'mobile' => '',
            'user_name' => '',
            'personnel_code' => 'required|size:4',
            'password' => 'required',
            'roles' => ''
        ];
    }
}
