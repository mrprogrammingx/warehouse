<?php

namespace App\Http\Controllers\Api\RolePermission;

use App\Http\Controllers\Controller;
use App\Services\RolePermission\PermissionService;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct()
    {
        $this->permissionService = new PermissionService();
    }

    /*
     * list of permission for set to user
     * 
     */
    public function getAllPermissions()
    {
        $result = $this->permissionService->getAllPermissions();

        return response()->json($result, $result['status']);
    }

    /*
     * list of permission of user id
     */
    public function getLoginUserPermissions()
    {
        $result = $this->permissionService->getLoginUserPermissions();

        return response()->json($result, $result['status']);
    }
}
