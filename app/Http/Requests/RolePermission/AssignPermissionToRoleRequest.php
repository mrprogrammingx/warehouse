<?php

namespace App\Http\Requests\RolePermission;

use App\Http\Requests\BaseFormRequest;

class AssignPermissionToRoleRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'roleName' => 'required',
            'permissionName' => 'required',
        ];
    }
}
