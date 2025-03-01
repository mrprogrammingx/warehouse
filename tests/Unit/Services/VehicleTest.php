<?php

namespace Tests\Unit\Services;

use App\Repositories\VehicleRepository;
use App\Services\VehicleService;
use Database\Factories\VehicleFactory;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    public VehicleService $vehicleService;
    public VehicleFactory $vehicleFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->vehicleFactory = new VehicleFactory();
        $this->vehicleService = app()->make('App\Services\VehicleService');

    }

    public function test_getAll():void
    {
        $response = $this->vehicleService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->vehicleService->store($this->vehicleFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $vehicle = $this->test_store();
        $response = $this->vehicleService->delete($vehicle->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $vehicle = $this->test_store();
        $response = $this->vehicleService->update($vehicle->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
