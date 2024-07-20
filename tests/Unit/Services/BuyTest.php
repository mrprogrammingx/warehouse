<?php

namespace Tests\Unit\Services;

use App\Repositories\BuyRepository;
use App\Services\BuyService;
use Database\Factories\BuyFactory;
use Tests\TestCase;

class BuyTest extends TestCase
{
    public BuyService $buyService;
    public BuyFactory $buyFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->buyFactory = new BuyFactory();
        $this->buyService = new BuyService(
            new BuyRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->buyService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->buyService->store($this->buyFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $buy = $this->test_store();
        $response = $this->buyService->delete($buy->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $buy = $this->test_store();
        $response = $this->buyService->update($buy->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
