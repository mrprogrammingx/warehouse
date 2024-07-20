<?php

namespace Tests\Unit\Services;

use App\Repositories\WarehouseDeliveryRepository;
use App\Services\WarehouseDeliveryService;
use Database\Factories\WarehouseDeliveryFactory;
use Tests\TestCase;

class WarehouseDeliveryTest extends TestCase
{
    public WarehouseDeliveryService $warehouseDeliveryService;
    public WarehouseDeliveryFactory $warehouseDeliveryFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->warehouseDeliveryFactory = new WarehouseDeliveryFactory();
        $this->warehouseDeliveryService = new WarehouseDeliveryService(
            new WarehouseDeliveryRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->warehouseDeliveryService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->warehouseDeliveryService->store($this->warehouseDeliveryFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $warehouseDelivery = $this->test_store();
        $response = $this->warehouseDeliveryService->delete($warehouseDelivery->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $warehouseDelivery = $this->test_store();
        $response = $this->warehouseDeliveryService->update($warehouseDelivery->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
