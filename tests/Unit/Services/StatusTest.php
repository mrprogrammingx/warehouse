<?php

namespace Tests\Unit\Services;

use App\Models\Status;
use App\Repositories\StatusRepository;
use App\Services\StatusService;
use Database\Factories\StatusFactory;
use Tests\TestCase;

class StatusTest extends TestCase
{
    public StatusService $statusService;
    public StatusFactory $statusFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->statusFactory = new StatusFactory();
        $this->statusService = new StatusService(
            new StatusRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->statusService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->statusService->store($this->statusFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $status = $this->test_store();
        $response = $this->statusService->delete($status->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $status = $this->test_store();
        $response = $this->statusService->update($status->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
