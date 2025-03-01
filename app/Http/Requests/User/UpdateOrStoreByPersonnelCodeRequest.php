<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class UpdateOrStoreByPersonnelCodeRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => ''
            // 'data.*.first_name' => '',
            // 'data.*.last_name' => '',
            // 'data.*.mobile' => '',
            // 'data.*.user_name' => '',
            // 'data.*.personnel_code' => 'required|size:4',
            // 'data.*.password' => 'required',
        ];
    }
}
