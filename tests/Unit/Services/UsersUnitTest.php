<?php

namespace Tests\Unit\Services;

use App\Services\UsersUnitService;
use Tests\TestCase;

class UsersUnitTest extends TestCase
{
    public UsersUnitService $usersUnitService;
    public function setUp(): void
    {
        parent::setUp();
        $this->usersUnitService = app(UsersUnitService::class);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_getUnitIdByUserId()
    {   
        $defaultUserId = 1;
        $response = $this->usersUnitService->getUnitIdByUserId($defaultUserId);
        $this->assertTrue(is_int($response) || is_null($response));
    }
}
