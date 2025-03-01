<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\StoreRequest;
use App\Http\Requests\Warehouse\UpdateRequest;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    protected $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function getAll()
    {
        $result = $this->warehouseService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->warehouseService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->warehouseService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->warehouseService->update($request->validated());

        return response()->json($result, $result['status']);
    }

    public function getAllActiveWarehouses()
    {
        $result = $this->warehouseService->getAllActiveWarehouses();

        return response()->json($result, $result['status']);
    }
}
