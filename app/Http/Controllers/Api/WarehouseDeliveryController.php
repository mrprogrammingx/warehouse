<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\warehouseDelivery\StoreRequest;
use App\Http\Requests\warehouseDelivery\UpdateRequest;
use App\Services\WarehouseDeliveryService;
use Illuminate\Http\Request;

class WarehouseDeliveryController extends Controller
{
    protected $warehouseDeliveryService;

    public function __construct(WarehouseDeliveryService $warehouseDeliveryService)
    {
        $this->warehouseDeliveryService = $warehouseDeliveryService;
    }

    public function getAll()
    {
        $result = $this->warehouseDeliveryService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->warehouseDeliveryService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->warehouseDeliveryService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->warehouseDeliveryService->update($request->validated());

        return response()->json($result, $result['status']);
    }
}
