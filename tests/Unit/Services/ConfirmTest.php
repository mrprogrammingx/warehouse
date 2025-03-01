<?php

namespace Tests\Unit\Services;

use App\Repositories\ConfirmRepository;
use App\Services\ConfirmService;
use Database\Factories\ConfirmFactory;
use Tests\TestCase;

class ConfirmTest extends TestCase
{
    public ConfirmService $confirmService;
    public ConfirmFactory $confirmFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->confirmFactory = new ConfirmFactory();
        $this->confirmService = new ConfirmService(
            new ConfirmRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->confirmService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->confirmService->store($this->confirmFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $confirm = $this->test_store();
        $response = $this->confirmService->delete($confirm->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $confirm = $this->test_store();
        $response = $this->confirmService->update($confirm->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
