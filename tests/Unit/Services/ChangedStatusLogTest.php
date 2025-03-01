<?php

namespace Tests\Unit\Services;

use App\Repositories\ChangedStatusLogRepository;
use App\Services\ChangedStatusLogService;
use App\Services\UserService;
use Database\Factories\ChangedStatusLogFactory;
use Tests\TestCase;

class ChangedStatusLogTest extends TestCase
{
    public ChangedStatusLogService $changedStatusLogService;
    public function setUp(): void
    {
        parent::setUp();
        $this->changedStatusLogService = new ChangedStatusLogService();
    }

    public function test_store(): ?object
    {
        $requestId = 1;
        $statusId = 1;
        $response = $this->changedStatusLogService->store(1, 1);
        $data = $response->toArray();
        $this->assertTrue(
            $data['request_id'] == $requestId &&
            $data['status_id'] == $statusId &&
            $data['user_id'] == UserService::getUserId()
        );
        return $response;
    }

}