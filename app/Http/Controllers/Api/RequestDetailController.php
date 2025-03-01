<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\requestDetail\IsConfirmedRequest;
use App\Http\Requests\requestDetail\SetDeliveredRequest;
use App\Http\Requests\requestDetail\SetWarehouseDeliveryIdRequest;
use App\Http\Requests\requestDetail\StoreRequest;
use App\Http\Requests\requestDetail\UpdateDeliveryIdRequest;
use App\Http\Requests\requestDetail\UpdateRequest;
use App\Http\Requests\requestDetail\UpdateWarehouseDeliveryIdRequest;
use App\Services\RequestDetailService;
use App\Services\RequestsDetailsConfirmService;
use Illuminate\Http\Request;

class RequestDetailController extends Controller
{
    protected $requestDetailService, $requestsDetailsConfirmService;
    public function __construct(RequestDetailService $requestDetailService, RequestsDetailsConfirmService $requestsDetailsConfirmService)
    {
        $this->requestDetailService = $requestDetailService;
        $this->requestsDetailsConfirmService = $requestsDetailsConfirmService;
    }

    public function getAll()
    {
        $result = $this->requestDetailService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->requestDetailService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->requestDetailService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->requestDetailService->update($request->validated());

        return response()->json($result, $result['status']);
    }

    public function updateDeliveryId(UpdateDeliveryIdRequest $request)
    {
        $result = $this->requestDetailService->updateDeliveryId($request->validated());

        return response()->json($result, $result['status']);
    }

    public function requestDetailIsConfirmed(IsConfirmedRequest $request)
    {
        $result = $this->requestsDetailsConfirmService->requestDetailIsConfirmed($request->validated()['requestDetailId']);

        return response()->json($result, $result['status'] ?? 200);
    }

    public function setDelivered(SetDeliveredRequest $request)
    {
        $result = $this->requestDetailService->setDelivered($request->validated());

        return response()->json($result, $result['status']);
    }

    public function updateWarehouseDeliveryId(UpdateWarehouseDeliveryIdRequest $request)
    {
        $result = $this->requestDetailService->updateWarehouseDeliveryId($request->validated());

        return response()->json($result, $result['status'] ?? 200);
    }

    public function setWarehouseDeliveryId(SetWarehouseDeliveryIdRequest $request)
    {
        $result = $this->requestDetailService->setWarehouseDeliveryId($request->validated());

        return response()->json($result, $result['status'] ?? 200);
    }
}
