<?php

namespace Tests\Unit\Services\RolePermission;

use App\Interfaces\RolePermissionInterface;
use App\Services\RolePermission\RoleService;
use Tests\TestCase;

class RoleTest extends TestCase
{
    public RoleService $roleService;
    public $permissionTest;
    public $allPermissions;
    public function setUp(): void
    {
        parent::setUp();
        $this->permissionTest = new PermissionTest();
        $this->roleService = new RoleService();
        $this->permissionTest->setUp();
        $this->allPermissions = $this->permissionTest->test_getAllPermissions();
    }
    public function test_getAllRoles()
    {
        $response = $this->roleService->getAllRoles();
        foreach ($response["data"] as $data) {
            $arrayData = $data->toArray();
            $this->assertTrue(
                array_key_exists('id', $arrayData) &&
                array_key_exists('name', $arrayData) &&
                array_key_exists('guard_name', $arrayData)
            );
        }

        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_addRoleToUser()
    {
        $response = $this->roleService->addRoleToUser([]);
        $this->assertTrue(count($response['data']->toArray()) >= 1);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_assignPermissionToRole(): void
    {
        if (count($this->allPermissions) > 0) {
            $data = [
                // 'permissionName' => [collect(['name' => $this->allPermissions[0]->name])],
                'permissionName' => $this->allPermissions,
                'roleName' => RolePermissionInterface::DEFAULT_ROLE,
            ];
            $response = $this->roleService->assignPermissionToRole($data);
            $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        } else {
            $this->assertTrue(true);
        }
    }

    public function test_buildArrayForAssignPermissionToRole()
    {
        if (count($this->allPermissions) > 0) {
            $data = [
                'permissionName' => $this->allPermissions[0],
                'roleName' => RolePermissionInterface::DEFAULT_ROLE,
            ];
            $this->roleService->buildArrayForAssignPermissionToRole($data['permissionName'],$data['roleName']);
        } else {
            $this->assertTrue(true);
        }
    }
}