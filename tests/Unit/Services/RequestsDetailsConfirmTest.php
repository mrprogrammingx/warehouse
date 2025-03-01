<?php

namespace Tests\Unit\Services;

use App\Services\RequestsDetailsConfirmService;
use Database\Factories\RequestsDetailsConfirmFactory;
use Tests\TestCase;

class RequestsDetailsConfirmTest extends TestCase
{
    public RequestsDetailsConfirmService $requestsDetailsConfirmService;
    public RequestDetailTest $requestDetailTest;
    public RequestTest $requestTest;
    public ProductTest $productTest;
    public RequestsDetailsConfirmFactory $requestsDetailsConfirmFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->requestsDetailsConfirmFactory = new RequestsDetailsConfirmFactory();
        $this->requestsDetailsConfirmService = new RequestsDetailsConfirmService();
        $this->requestDetailTest = new RequestDetailTest();
        $this->requestTest = new RequestTest();
        $this->productTest = new ProductTest();
    }

    public function test_getAll():void
    {
        $response = $this->requestsDetailsConfirmService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():array
    {
        $this->requestTest->setUp();
        $this->requestDetailTest->setUp();
        $data = $this->requestsDetailsConfirmFactory->definition();
        $request = $this->requestTest->test_store();
        $requestDetail = $this->requestDetailTest->test_store();

        $data['requests_detail_id'] = $requestDetail->id;
        $response = $this->requestsDetailsConfirmService->store([$data]);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        // var_dump($response);die;
        return $response['data'];
    }

    public function test_delete():void
    {
        $requestsDetailsConfirm = $this->test_store();
        $response = $this->requestsDetailsConfirmService->delete($requestsDetailsConfirm[0]->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $requestsDetailsConfirm = $this->test_store();
        $response = $this->requestsDetailsConfirmService->update($requestsDetailsConfirm[0]->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getRequestsDetailsByConfirmUserId()
    {
        $data['user_id'] = 1;
        $requestsDetailsConfirm = $this->test_store();
        $response = $this->requestsDetailsConfirmService->getRequestsDetailsByConfirmUserId($requestsDetailsConfirm[0]->toArray());
        $this->assertTrue(
            count($response->toArray()) >= 1
        );
    }

    public function test_confirmsOfRequestDetail():void
    {
        $requestsDetailsConfirm = $this->test_store();
        $response = $this->requestsDetailsConfirmService->confirmsOfRequestDetail($requestsDetailsConfirm[0]->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertGreaterThanOrEqual(
            count($response['data']->toArray())
            ,1);
    }

    public function test_confirmsOfRequest():void
    {
        $data = [
            'request_id' => 1,
        ];
        $response = $this->requestsDetailsConfirmService->confirmsOfRequest($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertGreaterThanOrEqual(
            count($response['data']->toArray())
            ,1);
    }

    public function test_updateByRequestDetailIdUserIdAndConfirmId():void
    {
        $requestsDetailsConfirm = $this->test_store();
        $data = $requestsDetailsConfirm[0]->toArray();
        $data['requests_detail_confirm_id'] = 1;
        $response = $this->requestsDetailsConfirmService->updateByRequestDetailIdUserIdAndConfirmId([$data]);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_storeConfirmsForProductId():void
    {
        $requestsDetailsConfirm = $this->test_store();
        $response = $this->requestsDetailsConfirmService->storeConfirmsForProductId(1,$requestsDetailsConfirm[0]->toArray()['requests_detail_id']);
        $this->assertIsArray($response);
    }

    public function test_storeConfirmsForCategoryId():void
    {
        $requestsDetailsConfirm = $this->test_store();
        $response = $this->requestsDetailsConfirmService->storeConfirmsForCategoryId(1,$requestsDetailsConfirm[0]->toArray()['requests_detail_id']);
        $this->assertIsArray($response);
    }

    public function test_storeDefinesConfirmsForRequestDetail():void 
    {
        $requestsDetailsConfirm = $this->test_store();
        $this->productTest->setUp();
        $productTest = $this->productTest->test_store();
        $response = $this->requestsDetailsConfirmService->storeDefinesConfirmsForRequestDetail($productTest->id,$requestsDetailsConfirm[0]->toArray()['requests_detail_id']);
        $this->assertIsArray($response);
    }

    public function test_requestIsConfirmed():void 
    {
        $response = $this->requestsDetailsConfirmService->requestIsConfirmed(1);
        $this->assertIsBool($response);
    }

    public function test_requestDetailsIsConfirmed():void
    {
        $requestsDetailsConfirm = $this->test_store();
        $requestsDetailId = $requestsDetailsConfirm[0]->toArray()['requests_detail_id'];
        $response = $this->requestsDetailsConfirmService->requestDetailsIsConfirmed([$requestsDetailId,$requestsDetailId]);
        $this->assertIsBool($response);
    }

    public function test_requestDetailIsConfirmed():void
    {
        $requestsDetailsConfirm = $this->test_store();
        $requestsDetailId = $requestsDetailsConfirm[0]->toArray()['requests_detail_id'];
        $response = $this->requestsDetailsConfirmService->requestDetailsIsConfirmed([$requestsDetailId,$requestsDetailId]);
        $this->assertIsBool($response);
    }

    public function test_checkConfirmsIsUnique():void
    {
        $requestsDetailsConfirm = $this->test_store();
        $data = $requestsDetailsConfirm[0]->toArray();
        $response = $this->requestsDetailsConfirmService->checkConfirmsIsUnique($data);
        $this->assertIsBool($response);
    }


    public function test_checkStatusBeInThem():void
    {
        $statusIds = [1,2,3];
        $this->requestTest->setUp();
        $requestTest = $this->requestTest->test_store();
        $response = $this->requestsDetailsConfirmService->checkStatusBeInThem($requestTest->id,$statusIds);
        $this->assertIsBool($response);
    }

}
