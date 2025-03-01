<?php

namespace Tests\Unit\Services\RolePermission;

use App\Services\RolePermission\PermissionService;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    public PermissionService $permissionService;
    public function setUp() :void
    {
        parent::setUp();
        $this->permissionService = new PermissionService();
    }

    public function test_getAllPermissions():?object
    {
        $response = $this->permissionService->getAllPermissions();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_getLoginUserPermissions():void
    {
        $response = $this->permissionService->getLoginUserPermissions();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
