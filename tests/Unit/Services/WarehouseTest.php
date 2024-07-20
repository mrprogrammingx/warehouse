<?php

namespace Tests\Unit\Services;

use App\Repositories\WarehouseRepository;
use App\Services\WarehouseService;
use Database\Factories\WarehouseFactory;
use Tests\TestCase;

class WarehouseTest extends TestCase
{
    public WarehouseService $warehouseService;
    public WarehouseFactory $warehouseFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->warehouseFactory = new WarehouseFactory();
        $this->warehouseService = new WarehouseService(
            new WarehouseRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->warehouseService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->warehouseService->store($this->warehouseFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $warehouse = $this->test_store();
        $response = $this->warehouseService->delete($warehouse->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $warehouse = $this->test_store();
        $response = $this->warehouseService->update($warehouse->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getAllActiveWarehouses()
    {
        $response = $this->warehouseService->getAllActiveWarehouses();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsArray($response['data']->toArray());
    }
}
