<?php

namespace Tests\Unit\Services;

use App\Interfaces\GlobalVariablesInterface;
use App\Repositories\RequestDetailRepository;
use App\Services\RequestDetailService;
use App\Services\UserService;
use Database\Factories\RequestDetailFactory;
use Tests\TestCase;

class RequestDetailTest extends TestCase
{
    public RequestDetailService $requestDetailService;
    public RequestDetailFactory $requestDetailFactory;
    public $requestDetail;
    public function setUp():void
    {
        parent::setUp();
        $this->requestDetailFactory = new RequestDetailFactory();
        $this->requestDetailService = new RequestDetailService(
            new RequestDetailRepository()
        );
        $this->requestDetail = $this->test_store();
    }

    public function test_getAll():void
    {
        $response = $this->requestDetailService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->requestDetailService->store($this->requestDetailFactory->definition());
        $result = $response['data'];
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertTrue(
            array_key_exists('id',$result->toArray())
        );
        return $result;
    }

    public function test_delete():void
    {
        // $requestDetail = $this->test_store();
        $response = $this->requestDetailService->delete($this->requestDetail->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        // $requestDetail = $this->test_store();
        $data = $this->requestDetail->toArray();
        $data['delivery_id'] = 2;
        $response = $this->requestDetailService->update(['requestDetails' => [$data]]);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_storeAndUpdateRequestDetailsEditLogAndRequestDetail()
    {
        $requestDetail = $this->requestDetail;
        $response = $this->requestDetailService->storeAndUpdateRequestDetailsEditLogAndRequestDetail(false,$requestDetail->toArray(),$requestDetail->toArray());
        $this->assertTrue($response);
    }

    public function test_storeOldAndNewDataInRequestDetailsEditLog()
    {
        // $requestDetail = $this->test_store();
        $data = $this->requestDetail->toArray();
        $data['requests_details_id'] = $data['id'];
        $data['user_id'] = UserService::getUserId() ?? null;
        $data['flag'] = GlobalVariablesInterface::NEW_DATA_FLAG;
        $data['edited'] = true;
        $response = $this->requestDetailService->storeOldAndNewDataInRequestDetailsEditLog($data,$data);
        $this->assertNull($response);
    }

    public function test_tableDataWithInputDataIsEqual()
    {
        $requestDetail = $this->requestDetail;
        $response = $this->requestDetailService->tableDataWithInputDataIsEqual($requestDetail->toArray(),$requestDetail->toArray());
        $this->assertIsBool($response);
    }

    public function test_updateDeliveryId()
    {
        // $requestDetail = $this->requestDetail;
        $response = $this->requestDetailService->updateDeliveryId([$this->requestDetail->toArray()]);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_setDelivered()
    {
        $data['requestDetailId'] = 1;
        $response = $this->requestDetailService->setDelivered($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_setStatusForRequestDetails()
    {
        $requestDetail = $this->requestDetail;
        $response = $this->requestDetailService->setStatusForRequestDetails([$requestDetail->id,$requestDetail->id],1);
        $this->assertNull($response);
    }

    public function test_checkDeliveryIdExist()
    {
        // $requestDetail = $this->test_store();
        $response = $this->requestDetailService->checkDeliveryIdExist($this->requestDetail->delivery_id);
        $this->assertIsBool($response);
    }

    public function test_updateWarehouseDeliveryId()
    {
        // $requestDetail = $this->requestDetail;
        $data = [
            'id' => $this->requestDetail->id,
            'warehouseDeliveryId' => 1
        ];
        $response = $this->requestDetailService->updateWarehouseDeliveryId($data);
        $this->assertEquals($response,1);
    } 

    public function test_updateHasRemittanceByRequestId()
    {
        $data = [
            'requestId' => 1,
            'hasRemittance' => 1
        ];
        $response = $this->requestDetailService->updateHasRemittanceByRequestId($data);
        $this->assertTrue(in_array($response,[0,1]));
    }

    public function test_hasRemittanceIsZeroForRequestId()
    {
        $data = [
            'requestId' => 1
        ];
        $response = $this->requestDetailService->hasRemittanceIsZeroForRequestId($data);
        $this->assertIsBool($response);
    }

    public function test_setWarehouseDeliveryId()
    {
        $data = [
            'requestId' => $this->requestDetail->id,
            'warehouseDeliveryId' => 1
        ];

        $response = $this->requestDetailService->setWarehouseDeliveryId($data);
        $this->assertTrue(in_array($response,[0,1]));
    }

    public function test_getById()
    {
        $response = $this->requestDetailService->getById($this->requestDetail->id);
        $this->assertTrue(
            array_key_exists('id',$response->toArray())
        );
    }

    public function test_updateForDeliveredToWarehouse()
    {
        $response = $this->requestDetailService->updateForDeliveredToWarehouse([$this->requestDetail->id,$this->requestDetail->id]);
        $this->assertTrue($response == [1,1]);
    }
}
