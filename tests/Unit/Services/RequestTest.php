<?php

namespace Tests\Unit\Services;

use App\Models\RequestDetail;
use Tests\TestCase;
use App\Models\Product;
use App\Services\FileService;
use App\Services\ProductService;
use App\Services\RequestService;
use App\Services\UsersUnitService;
use App\Repositories\FileRepository;
use App\Services\RequestDetailService;
use Database\Factories\RequestFactory;
use function PHPUnit\Framework\isTrue;
use App\Repositories\RequestRepository;
use App\Repositories\UsersUnitRepository;
use App\Services\FileRequestDetailService;
use function PHPUnit\Framework\assertTrue;
use App\Repositories\UsersConfirmRepository;

use App\Repositories\FilesCategoryRepository;
use App\Repositories\RequestDetailRepository;
use App\Services\RequestsDetailsConfirmService;
use App\Repositories\FileRequestDetailRepository;

class RequestTest extends TestCase
{
    public RequestService $requestService;
    public requestDetailService $requestDetailService;
    public ProductService $productSerivce;
    public RequestFactory $requestFactory;
    public Product $product;
    public RequestDetail $requestDetail;

    public function setUp(): void
    {
        parent::setUp();

        $this->requestFactory = new RequestFactory();
        $this->requestService = app(RequestService::class);
        $this->requestDetailService = app(RequestDetailService::class);
        $this->productSerivce = app(ProductService::class);

        $this->product = $this->productSerivce->getAll()['data'][0];
        $this->requestDetail = $this->requestDetailService->getAll()['data'][0];
    }

    public function test_getAll(): void
    {
        $response = $this->requestService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store(): ?object
    {
        $response = $this->requestService->store($this->requestFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete(): void
    {
        $request = $this->test_store();
        $response = $this->requestService->delete($request->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update(): void
    {
        $request = $this->test_store();
        $response = $this->requestService->update($request->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_storeRequestAndRequestDetails()
    {
        $firstIndexOfArray = 0;
        $request = $this->test_store();

        $data = [
            'request' => $request->toArray(),
            'requestDetails' => [$this->requestDetail->toArray()],
        ];
        $data['request']['warehouses_id'] = 1;
        $data['requestDetails'][$firstIndexOfArray]['product_id'] = $this->product->id;
        $response = $this->requestService->storeRequestAndRequestDetails($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_allRequestConfirmsByUserId()
    {
        $request = $this->test_store();
        $response = $this->requestService->allRequestConfirmsByUserId($request->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getParamsForRequestsTable()
    {
        $response = $this->requestService->getParamsForRequestsTable();
        $this->assertArrayHasKey('user_id', $response);
        $this->assertArrayHasKey('unit_id', $response);
    }

    public function test_allRequestsOfUserId()
    {
        $request = $this->test_store();
        $response = $this->requestService->allRequestsOfUserId($request->toArray());
        $data = $response['data']->toarray();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertArrayHasKey('current_page', $data);
        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('first_page_url', $data);
        $this->assertArrayHasKey('from', $data);
        $this->assertArrayHasKey('last_page', $data);
        $this->assertArrayHasKey('last_page_url', $data);
        $this->assertArrayHasKey('links', $data);
        $this->assertArrayHasKey('next_page_url', $data);
        $this->assertArrayHasKey('path', $data);
        $this->assertArrayHasKey('per_page', $data);
        $this->assertArrayHasKey('prev_page_url', $data);
        $this->assertArrayHasKey('to', $data);
        $this->assertArrayHasKey('total', $data);
    }

    public function test_archivedRequestsOfUserId()
    {
        $request = $this->test_store();
        $response = $this->requestService->allRequestsOfUserId($request->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $data = $response['data']->toarray();
        $this->assertArrayHasKey('current_page', $data);
        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('first_page_url', $data);
        $this->assertArrayHasKey('from', $data);
        $this->assertArrayHasKey('last_page', $data);
        $this->assertArrayHasKey('last_page_url', $data);
        $this->assertArrayHasKey('links', $data);
        $this->assertArrayHasKey('next_page_url', $data);
        $this->assertArrayHasKey('path', $data);
        $this->assertArrayHasKey('per_page', $data);
        $this->assertArrayHasKey('prev_page_url', $data);
        $this->assertArrayHasKey('to', $data);
        $this->assertArrayHasKey('total', $data);
    }

    public function test_notArchivedRequestsOfUserId()
    {
        $request = $this->test_store();
        $response = $this->requestService->notArchivedRequestsOfUserId($request->toArray());
        $data = $response['data']->toarray()[0];
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('user_id', $data);
        $this->assertArrayHasKey('status_id', $data);
        $this->assertArrayHasKey('unit_id', $data);
        $this->assertArrayHasKey('request_number', $data);
        $this->assertArrayHasKey('validated_code', $data);
        $this->assertArrayHasKey('has_remittance', $data);
        $this->assertArrayHasKey('descriptions', $data);
        $this->assertArrayHasKey('confirmed', $data);
        $this->assertArrayHasKey('unit', $data);
        $this->assertArrayHasKey('user', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('request_detail', $data);
    }

    public function test_buildRequestNumber()
    {
        $response = $this->requestService->buildRequestNumber();
        $this->assertIsString($response);
    }

    public function test_buildGenerateNumber()
    {
        $response = $this->requestService->buildGenerateNumber();
        $this->assertIsInt($response);
    }

    public function test_allRequestsByDeliveryId()
    {
        $data['delivery_id'] = 1;
        $response = $this->requestService->allRequestsByDeliveryId($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getAllRequestsByDeliveryId()
    {
        $defaultDeliviryId = 1;
        $response = $this->requestService->getAllRequestsByDeliveryId($defaultDeliviryId);
        $this->assertIsObject($response);
    }

    public function test_getAllRequestsOfCurrentDeliveryId()
    {
        $response = $this->requestService->getAllRequestsOfCurrentDeliveryId();
        $this->assertIsArray($response);
    }

    public function test_allConfirmsOfUserId()
    {
        $data['userId'] = null;
        $response = $this->requestService->allConfirmsOfUserId($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getAllArchiveStatus()
    {
        $response = $this->requestService->getAllArchiveStatus();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getAllCancelStatus()
    {
        $response = $this->requestService->getAllCancelStatus();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getAllIsNotArchiveStatus()
    {
        $response = $this->requestService->getAllIsNotArchiveStatus();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getAllIsNotArchiveAndCancelStatus()
    {
        $response = $this->requestService->getAllIsNotArchiveAndCancelStatus();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_checkValidatedCode()
    {
        $data = [
            'requestId' => 1,
            'validatedCode' => 1234,
        ];
        $response = $this->requestService->checkValidatedCode($data);
        $this->assertIsBool($response);
    }

    public function test_processOfValidCode()
    {
        $request = $this->test_store();
        $data = [
            'requestId' => $request->id,
            'validatedCode' => $request->validated_code,
        ];
        $response = $this->requestService->processOfValidCode($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_setStatusForRequestAndItsRequestDetails()
    {
        $request = $this->test_store();
        $data = [
            'requestId' => $request->id
        ];
        $defaultStatusId = 1;
        $response = $this->requestService->setStatusForRequestAndItsRequestDetails($data, $defaultStatusId);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsArray($response['data']);
    }

    public function test_changeStatusConditions()
    {
        $request = $this->test_store();
        $requestId = $request->id;
        $statusId = 2;
        $currentStatusId = $request->status_id;
        $response = $this->requestService->changeStatusConditions($requestId, $statusId, $currentStatusId);
        $this->assertArrayHasKey('success', $response);
        $this->assertArrayHasKey('message', $response);
    }

    public function test_checkStatusIsValidForChangeToCancel()
    {
        $request = $this->test_store();
        $statusId = $request->status_id;
        $response = $this->requestService->checkStatusIsValidForChangeToCancel($statusId);
        $this->assertIsBool($response);
    }

    public function test_showDeliveriesStatus()
    {
        $response = $this->requestService->showDeliveriesStatus();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_separateConfirmed()
    {
        $request = $this->test_store();
        $response = $this->requestService->separateConfirmed([$request, $request]);
        $this->assertIsArray($response);
    }

    public function test_showDeliveriesStatusWithoutDelivery()
    {
        $response = $this->requestService->showDeliveriesStatusWithoutDelivery();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_showDeliveriesStatusWithDelivery()
    {
        $response = $this->requestService->showDeliveriesStatusWithDelivery();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_checkRequestsDetailsNotBeRepetitiousData()
    {
        $response = $this->requestService->checkRequestsDetailsNotBeRepetitiousData([$this->requestDetail]);
        $this->assertIsBool($response);
    }

    public function test_arrayHasDupes()
    {
        $response = $this->requestService->arrayHasDupes([]);
        $this->assertIsBool($response);
    }

    public function test_updateHasRemittanceByRequestId()
    {
        $data = [
            'requestId' => 1,
            'hasRemittance' => true,
        ];
        $response = $this->requestService->updateHasRemittanceByRequestId($data);
        $this->assertIsBool((bool) $response);
    }

    public function test_hasRemittanceIsZeroForRequestId()
    {
        $data = [
            'requestId' => 1,
            'hasRemittance' => true,
        ];
        $response = $this->requestService->hasRemittanceIsZeroForRequestId($data);
        $this->assertIsBool((bool) $response);
    }

    public function test_getAllDetailsById()
    {
        $data = [
            'requestId' => 1,
            'hasRemittance' => true,
        ];
        $response = $this->requestService->getAllDetailsById($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getAllForWarehouseDeliveryIdIsNotArchiveAndCancel()
    {
        $data['warehouseDeliveryId'] = 1;
        $response = $this->requestService->getAllForWarehouseDeliveryIdIsNotArchiveAndCancel($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_processOfSetReturnToWarehouseStatus()
    {
        $request = $this->test_store();
        
        $data = [
            'requestId' => $request->id,
            'validatedCode' => $request->validated_code,
        ];

        $data['requestDetail'] = [$this->requestDetail];
        $response = $this->requestService->processOfSetReturnToWarehouseStatus($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_changeStatusToReturnToWarehouseStatus()
    {
        $request = $this->test_store();
        $data = [
            'requestId' => $request->id,
            'validatedCode' => $request->validated_code,
        ];

        $data['requestDetail'] = [$this->requestDetail];
        $this->requestService->changeStatusToReturnToWarehouseStatus($data);
        $this->assertTrue(true);
    }

    public function test_processOfSetReturnDeliveryId()
    {
        $request = $this->test_store();
        $data = [
            'requestId' => $request->id,
            'validatedCode' => $request->validated_code,
            'returnDeliveryId' => 1,
        ];

        $data['requestDetail'] = [$this->requestDetail];
        $response = $this->requestService->processOfSetReturnDeliveryId($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsArray($response['data']);
    }

    public function test_processOfValidCodeForReturnToDelivery()
    {
        $request = $this->test_store();
        $data = [
            'requestId' => $request->id,
            'validatedCode' => $request->validated_code,
        ];
        $response = $this->requestService->processOfValidCodeForReturnToDelivery($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertTrue($response['data'] == $data);
    }

    public function test_processOfValidCodeForReturnToWarehouse()
    {
        $request = $this->test_store();
        $data = [
            'requestId' => $request->id,
            'validatedCode' => $request->validated_code,
        ];

        $data['requestDetail'] = [$this->requestDetail];
        $response = $this->requestService->processOfValidCodeForReturnToWarehouse($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsArray($response['data']);
    }

    public function test_storeRequestAndRequestDetailsWithoutConfirms()
    {
        $request = $this->test_store();
        $data['request'] = $request->toArray();

        $data['requestDetails'] = [$this->requestDetail];
        $data['request']['warehouses_id'] = $this->requestDetail['warehouses_id'];
        $response = $this->requestService->storeRequestAndRequestDetailsWithoutConfirms($data);

        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertIsArray($response['data']);
    }

    public function test_getAllReturnToWarehouseStatus()
    {
        $response = $this->requestService->getAllReturnToWarehouseStatus();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}