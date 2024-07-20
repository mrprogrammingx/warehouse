<?php

namespace Tests\Unit\Services;

use App\Repositories\UsersConfirmRepository;
use App\Services\UsersConfirmService;
use Database\Factories\UsersConfirmFactory;
use Tests\TestCase;

class UsersConfirmTest extends TestCase
{
    public UsersConfirmService $usersConfirmService;
    public UsersConfirmFactory $usersConfirmFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->usersConfirmFactory = new UsersConfirmFactory();
        $this->usersConfirmService = new UsersConfirmService(
            new UsersConfirmRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->usersConfirmService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->usersConfirmService->store($this->usersConfirmFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $usersConfirm = $this->test_store();
        $response = $this->usersConfirmService->delete($usersConfirm->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $usersConfirm = $this->test_store();
        $response = $this->usersConfirmService->update($usersConfirm->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getByUserId()
    {
        $defaultUserId = 1;
        $data['user_id'] = $defaultUserId;
        $response = $this->usersConfirmService->getByUserId($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_setInactiveStatusByUserConfirmId() 
    {
        $defaultUserId = 1;
        $data['userConfirmId'] = $defaultUserId;
        $response = $this->usersConfirmService->setInactiveStatusByUserConfirmId($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
