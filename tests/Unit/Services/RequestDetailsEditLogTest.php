<?php

namespace Tests\Unit\Services;

use App\Services\RequestDetailsEditLogService;
use Database\Factories\RequestDetailsEditLogFactory;
use Tests\TestCase;

class RequestDetailsEditLogTest extends TestCase
{
    public RequestDetailsEditLogService $requestDetailsEditLogService;
    public RequestDetailsEditLogFactory $requestDetailsEditLogFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->requestDetailsEditLogFactory = new RequestDetailsEditLogFactory();
        $this->requestDetailsEditLogService = new RequestDetailsEditLogService();
    }

    public function test_store():?object
    {
        $response = $this->requestDetailsEditLogService->store($this->requestDetailsEditLogFactory->definition());
        
        $data = $response->toArray();
        $this->assertTrue(
            $data['id'] == 1 &&
            $data['requests_details_id'] == 1 &&
            $data['user_id'] == 1 &&
            $data['flag'] == 1 &&
            $data['request_id'] == 1 &&
            $data['product_id'] == 1 &&
            $data['status_id'] == 1 &&
            $data['delivery_id'] == 1 &&
            $data['warehouses_id'] == 1 &&
            $data['warehouse_delivery_id'] == 1 &&
            $data['amount'] == 1 &&
            $data['location'] == 0 &&
            $data['center_id'] == 1 &&
            $data['worn'] == 1 &&
            $data['worn_amount'] == 1 &&
            $data['delivered'] == 1 &&
            $data['has_remittance'] == 0 &&
            array_key_exists('descriptions', $data)
        );
        return $response;
    }
}
