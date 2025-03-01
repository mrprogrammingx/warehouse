<?php

namespace App\Http\Controllers\Api\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\rolePermission\AddRoleToUserRequest;
use App\Http\Requests\rolePermission\AssignPermissionToRoleRequest;
use App\Services\RolePermission\RoleService;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService();
    }

    public function getAllRoles()
    {
        $result = $this->roleService->getAllRoles();

        return response()->json($result, $result['status']);
    }

    public function addRoleToUser(AddRoleToUserRequest $request)
    {
        $result = $this->roleService->addRoleToUser($request->validated());

        return response()->json($result, $result['status']);
    }

    public function assignPermissionToRole(AssignPermissionToRoleRequest $request)
    {
        $result = $this->roleService->assignPermissionToRole($request->validated());

        return response()->json($result, $result['status']);
    }
}
