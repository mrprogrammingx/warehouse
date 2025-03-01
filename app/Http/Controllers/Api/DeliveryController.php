<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delivery\StoreRequest;
use App\Http\Requests\Delivery\UpdateOnlineStatusRequest;
use App\Http\Requests\Delivery\UpdateRequest;
use App\Services\DeliveryService;

class DeliveryController extends Controller
{
    protected $deliveryService;
    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    public function getAll()
    {
        $result = $this->deliveryService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->deliveryService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete($id)
    {
        $result = $this->deliveryService->delete($id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->deliveryService->update($request->validated());

        return response()->json($result, $result['status']);
    }

    public function updateOnlineStatus(UpdateOnlineStatusRequest $request)
    {
        $result = $this->deliveryService->updateOnlineStatus($request->validated());

        return response()->json($result, $result['status']);
    }
}
