<?php

namespace Tests\Unit\Services;

use App\Repositories\DeliveryRepository;
use App\Repositories\RequestDetailRepository;
use App\Services\DeliveryService;
use App\Services\RequestDetailService;
use Database\Factories\DeliveryFactory;
use Tests\TestCase;

class DeliveryTest extends TestCase
{
    public DeliveryService $deliveryService;
    public DeliveryFactory $deliveryFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->deliveryFactory = new DeliveryFactory();
        $this->deliveryService = new DeliveryService(
            new DeliveryRepository(),
            new RequestDetailService(
                new RequestDetailRepository()
            )
        );
    }

    public function test_getAll():void
    {
        $response = $this->deliveryService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->deliveryService->store($this->deliveryFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $delivery = $this->test_store();
        $response = $this->deliveryService->delete($delivery->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $delivery = $this->test_store();
        $response = $this->deliveryService->update($delivery->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_updateOnlineStatus()
    {
        $delivery = $this->test_store();
        $response = $this->deliveryService->updateOnlineStatus($delivery->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_checkVehicleExist()
    {
        $delivery = $this->test_store();
        $response = $this->deliveryService->checkVehicleExist($delivery->toArray()['vehicle_id']);
        $this->assertIsBool($response);
    }
}
