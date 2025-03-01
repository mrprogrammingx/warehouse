<?php

namespace Tests\Unit\Services;

use App\Services\UserService;
use Database\Factories\UserFactory;
use Tests\TestCase;

class UserTest extends TestCase
{
    public UserService $userService;
    public UserFactory $userFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->userFactory = new UserFactory();
        $this->userService = new UserService();
    }

    public function test_getAll():void
    {
        $response = $this->userService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->userService->store($this->userFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $user = $this->test_store();
        $response = $this->userService->delete($user->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $user = $this->test_store();
        $data = $user->toArray();
        $data['password'] = $this->userFactory->definition()['password'];
        $response = $this->userService->update($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getUserId() 
    {
        $response = $this->userService->getUserId();
        $this->assertIsInt($response);
    }

    public function test_getById() 
    {
        $data['id'] = $this->userService->getUserId();
        $response = $this->userService->getById($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsArray($response['data']->toArray());
    }

    public function test_addRolesToUsers()
    {
        $user = $this->test_store();
        $response = $this->userService->getById([$user]);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsArray($response['data']->toArray());
    }

    public function test_updateOrStoreByPersonnelCode() 
    {
        $data['data'] = [$this->test_store()];
        $response = $this->userService->getById($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsArray($response['data']->toArray());
    }

    public function test_getLoginUserPermissions()
    {
        $response = $this->userService->getLoginUserPermissions(); 
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsBool($response['data']);
    }

    public function test_changeUserStatus()
    {
        $user = $this->test_store();
        $response = $this->userService->changeUserStatus($user);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsArray($response['data']->toArray());
    }
}
