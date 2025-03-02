<?php

namespace Tests\Unit\Services;

use App\Models\RequestDetail;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Request;
use App\Services\ProductService;
use App\Services\RequestService;
use App\Services\RequestDetailService;
use App\Services\RequestsDetailsConfirmService;
use Database\Factories\RequestsDetailsConfirmFactory;

class RequestsDetailsConfirmTest extends TestCase
{
    public RequestsDetailsConfirmService $requestsDetailsConfirmService;
    public RequestDetailService $requestDetailService;
    public RequestService $requestService;
    public ProductService $productService;
    public RequestsDetailsConfirmFactory $requestsDetailsConfirmFactory;
    public Request $request;
    public Product $product;
    public RequestDetail $requestDetail;

    public function setUp():void
    {
        parent::setUp();
        $this->requestsDetailsConfirmFactory = app(RequestsDetailsConfirmFactory::class);
        $this->requestsDetailsConfirmService = app(RequestsDetailsConfirmService::class);
        $this->requestDetailService = app(RequestDetailService::class);
        $this->requestService = app(RequestService::class);
        $this->productService = app(ProductService::class);

        $this->request = $this->requestService->getAll()['data'][0];
        $this->product = $this->productService->getAll()['data'][0];
        $this->requestDetail = $this->requestDetailService->getAll()['data'][0];
    }

    public function test_getAll():void
    {
        $response = $this->requestsDetailsConfirmService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():array
    {
        $data = $this->requestsDetailsConfirmFactory->definition();

        $data['requests_detail_id'] = $this->requestDetail->id;
        $response = $this->requestsDetailsConfirmService->store([$data]);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);

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

        $response = $this->requestsDetailsConfirmService->storeDefinesConfirmsForRequestDetail($this->product->id,$requestsDetailsConfirm[0]->toArray()['requests_detail_id']);
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

        $response = $this->requestsDetailsConfirmService->checkStatusBeInThem($this->request->id,$statusIds);
        $this->assertIsBool($response);
    }

}
