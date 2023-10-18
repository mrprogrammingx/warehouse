<?php

namespace App\Services\RolePermission;

use App\Repositories\RolePermission\PermissionRepository;
use App\Repositories\UserRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class PermissionService
 * @package App\Services
 */
class PermissionService
{

    protected $permissionRepository;

    public function __construct()
    {
        $this->permissionRepository = new PermissionRepository();
    }

    public function getAllPermissions():array
    {
        return ResponsesService::success($this->permissionRepository->getAllPermissions());
    }

    public function getLoginUserPermissions():array
    {
        $permissions = [];
        foreach ($this->permissionRepository->getAllPermissions() as $permission) {
            if (auth()->user()->can($permission->name)) {
                $permissions[] = $permission->name;
            }
        }
        return ResponsesService::success($permissions);
    }


}
