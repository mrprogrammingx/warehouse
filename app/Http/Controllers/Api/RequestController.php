<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\request\CheckValidatedCodeRequest;
use App\Http\Requests\request\GetAllDetailsByIdRequest;
use App\Http\Requests\request\GetAllForWarehouseDeliveryIdIsNotArchiveAndCancelRequest;
use App\Http\Requests\request\GetByDeliveryIdRequest;
use App\Http\Requests\request\GetByUserIdRequest;
use App\Http\Requests\request\StoreRequest;
use App\Http\Requests\request\StoreRequestAndRequestDetailsRequest;
use App\Http\Requests\request\UpdateRequest;
use App\Http\Requests\request\IsConfirmedRequest;
use App\Http\Requests\request\ProcessOfSetReturnDeliveryIdRequest;
use App\Http\Requests\request\ProcessOfSetReturnToWarehouseStatusRequest;
use App\Http\Requests\request\ProcessOfValidCodeForReturnToDeliveryRequest;
use App\Http\Requests\request\ProcessOfValidCodeForReturnToWarehouse;
use App\Http\Requests\request\SetRequestStatusRequest;
use App\Http\Requests\request\StoreRequestAndRequestDetailsWithoutConfirmsRequest;
use App\Services\Globals\ResponsesService;
use App\Services\RequestsDetailsConfirmService;
use App\Services\RequestService;
use App\Services\TimeService;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected $requestService, $timeService, $requestsDetailsConfirmService;
    public function __construct(RequestService $requestService, RequestsDetailsConfirmService $requestsDetailsConfirmService)
    {
        $this->requestService = $requestService;
        $this->requestsDetailsConfirmService = $requestsDetailsConfirmService;
        $this->timeService = new TimeService();
    }

    public function getAll()
    {
        $result = $this->requestService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->requestService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->requestService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->requestService->update($request->validated());

        return response()->json($result, $result['status']);
    }

    public function storeRequestAndRequestDetails(StoreRequestAndRequestDetailsRequest $request)
    {
        $result = $this->requestService->storeRequestAndRequestDetails($request->validated());

        return response()->json($result, $result['status']);
    }

    public function getCurrentDate()
    {
        $result = ResponsesService::success($this->timeService->currentManualDate());

        return response()->json($result, $result['status']);
    }

    public function allRequestsOfUserId(GetByUserIdRequest $request)
    {
        $result = $this->requestService->allRequestsOfUserId($request->validated());

        return response()->json($result, $result['status']);
    }



    public function archivedRequestsOfUserId(GetByUserIdRequest $request)
    {
        $result = $this->requestService->archivedRequestsOfUserId($request->validated());

        return response()->json($result, $result['status']);
    }

    public function notArchivedRequestsOfUserId(GetByUserIdRequest $request)
    {
        $result = ResponsesService::success($this->requestService->notArchivedRequestsOfUserId($request->validated()));

        return response()->json($result, $result['status']);
    }

    public function allRequestConfirmsByUserId(GetByUserIdRequest $request)
    {
        $result = $this->requestService->allRequestConfirmsByUserId($request->validated());

        return response()->json($result, $result['status']);
    }

    public function allRequestsByDeliveryId(GetByDeliveryIdRequest $request)
    {
        $result = $this->requestService->allRequestsByDeliveryId($request->validated());

        return response()->json($result, $result['status']);
    }


    public function allConfirmsOfUserId(GetByUserIdRequest $request)
    {
        $result = $this->requestService->allConfirmsOfUserId($request->validated());

        return response()->json($result, $result['status']);
    }

    public function requestIsConfirmed(IsConfirmedRequest $request)
    {
        $result = ResponsesService::success($this->requestsDetailsConfirmService->requestIsConfirmed($request->validated()['requestId']));

        return response()->json($result, $result['status']);
    }

    public function getAllArchiveStatus()
    {
        $result = $this->requestService->getAllArchiveStatus();

        return response()->json($result, $result['status']);
    }

    public function getAllCancelStatus()
    {
        $result = $this->requestService->getAllCancelStatus();

        return response()->json($result, $result['status']);
    }

    public function getAllIsNotArchiveStatus()
    {
        $result = $this->requestService->getAllIsNotArchiveStatus();

        return response()->json($result, $result['status']);
    }

    public function getAllIsNotArchiveAndCancelStatus()
    {
        $result = $this->requestService->getAllIsNotArchiveAndCancelStatus();

        return response()->json($result, $result['status']);
    }

    public function checkValidatedCode(CheckValidatedCodeRequest $request)
    {
        $result = $this->requestService->processOfValidCode($request->validated());

        return response()->json($result, $result['status']);
    }

    public function setStatusForRequestAndItsRequestDetails(SetRequestStatusRequest $request, int $statusId)
    {
        $result = $this->requestService->setStatusForRequestAndItsRequestDetails($request->validated(), $statusId);

        return response()->json($result, $result['status']);
    }

    public function showDeliveriesStatus()
    {
        $result = $this->requestService->showDeliveriesStatus();

        return response()->json($result, $result['status']);
    }

    public function showDeliveriesStatusWithoutDelivery()
    {
        $result = $this->requestService->showDeliveriesStatusWithoutDelivery();

        return response()->json($result, $result['status']);
    }

    public function showDeliveriesStatusWithDelivery()
    {
        $result = $this->requestService->showDeliveriesStatusWithDelivery();

        return response()->json($result, $result['status']);
    }

    public function getAllDetailsById(GetAllDetailsByIdRequest $request)
    {
        $result = $this->requestService->getAllDetailsById($request->validated());

        return response()->json($result, $result['status']);
    }

    public function getAllForWarehouseDeliveryIdIsNotArchiveAndCancel(GetAllForWarehouseDeliveryIdIsNotArchiveAndCancelRequest $request)
    {
        $result = $this->requestService->getAllForWarehouseDeliveryIdIsNotArchiveAndCancel($request->validated());

        return response()->json($result, $result['status']);
    }

    public function processOfSetReturnToWarehouseStatus(ProcessOfSetReturnToWarehouseStatusRequest $request)
    {
        $result = $this->requestService->processOfSetReturnToWarehouseStatus($request->validated());

        return response()->json($result, $result['status']);
    }

    public function processOfSetReturnDeliveryId(ProcessOfSetReturnDeliveryIdRequest $request)
    {
        $result = $this->requestService->processOfSetReturnDeliveryId($request->validated());

        return response()->json($result, $result['status']);
    }

    public function processOfValidCodeForReturnToDelivery(ProcessOfValidCodeForReturnToDeliveryRequest $request)
    {
        $result = $this->requestService->processOfValidCodeForReturnToDelivery($request->validated());

        return response()->json($result, $result['status']);
    }

    public function processOfValidCodeForReturnToWarehouse(ProcessOfValidCodeForReturnToWarehouse $request)
    {
        $result = $this->requestService->processOfValidCodeForReturnToWarehouse($request->validated());

        return response()->json($result, $result['status']);
    }

    public function storeRequestAndRequestDetailsWithoutConfirms(StoreRequestAndRequestDetailsWithoutConfirmsRequest $request)
    {
        $result = $this->requestService->storeRequestAndRequestDetailsWithoutConfirms($request->validated());

        return response()->json($result, $result['status']);
    }

    public function getAllReturnToWarehouseStatus()
    {
        $result = $this->requestService->getAllReturnToWarehouseStatus();

        return response()->json($result, $result['status']);
    }
}
