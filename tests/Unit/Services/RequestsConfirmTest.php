<?php

namespace Tests\Unit\Services;

use App\Repositories\RequestsConfirmRepository;
use App\Services\RequestsConfirmService;
use Database\Factories\RequestsConfirmFactory;
use Tests\TestCase;

class RequestsConfirmTest extends TestCase
{
    public RequestsConfirmService $requestsConfirmService;
    public RequestsConfirmFactory $requestsConfirmFactory;
    public $requestsConfirm;
    public function setUp():void
    {
        parent::setUp();
        $this->requestsConfirmFactory = new RequestsConfirmFactory();
        $this->requestsConfirmService = new RequestsConfirmService(
            new RequestsConfirmRepository()
        );
        // $this->requestsConfirm = $this->test_store();
    }

    public function test_getAll():void
    {
        $response = $this->requestsConfirmService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->requestsConfirmService->store($this->requestsConfirmFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $requestsConfirm = $this->test_store();
        $response = $this->requestsConfirmService->delete($requestsConfirm->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $requestsConfirm = $this->test_store();
        $response = $this->requestsConfirmService->update($requestsConfirm->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
    
    public function test_getRequestsByDeliveryId()
    {
        $requestsConfirm = $this->test_store();
        $this->requestsConfirmService->getRequestsByDeliveryId($requestsConfirm->toArray());
    }

}
