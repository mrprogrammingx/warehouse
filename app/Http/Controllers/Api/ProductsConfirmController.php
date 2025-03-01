<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\productsConfirm\GetByProductIdRequest;
use App\Http\Requests\productsConfirm\StoreRequest;
use App\Services\ProductsConfirmService;

class ProductsConfirmController extends Controller
{
    protected $productsConfirmService;
    public function __construct(ProductsConfirmService $productsConfirmService)
    {
        $this->productsConfirmService = $productsConfirmService;
    }

    public function getAll()
    {
        $result = $this->productsConfirmService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->productsConfirmService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function getByProductId(GetByProductIdRequest $request)
    {
        $result = $this->productsConfirmService->getByProductId($request->validated());

        return response()->json($result, $result['status']);
    }
}
