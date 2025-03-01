<?php

namespace App\Services\RolePermission;

use App\Interfaces\GlobalVariablesInterface;
use App\Interfaces\RolePermissionInterface;
use App\Repositories\RolePermission\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\Globals\ResponsesService;
use App\Services\UserService;

/**
 * Class RoleService
 * @package App\Services
 */
class RoleService
{
    protected $roleRepository, $userRepository;

    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
        $this->userRepository = new UserRepository();
    }

    public function getAllRoles()
    {
        return ResponsesService::success($this->roleRepository->getAllRoles());
    }

    public function addRoleToUser(array $data)
    {
        $role = $data['role'] ?? RolePermissionInterface::DEFAULT_ROLE;
        $userId = $data['userId'] ?? UserService::getUserId();
        return ResponsesService::success($this->userRepository->getById($userId)->syncRoles($role));
    }

    public function assignPermissionToRole($data)
    {
        foreach ($data["permissionName"] as $datum) {
            $result[] = $this->roleRepository->assignPermissionToRole($this->buildArrayForAssignPermissionToRole($datum, $data["roleName"]));
        }
        return ResponsesService::success($result);
    }

    public function buildArrayForAssignPermissionToRole($datum, $roleName)
    {
        $firstIndex = 0;
        return [
            'permissionName' => array(json_decode($datum))[$firstIndex]->name,
            'roleName' => $roleName
        ];
    }
}
