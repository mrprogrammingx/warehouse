<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\GetAllRecordsOfProductByIdRequest;
use App\Http\Requests\Product\ProductsByWarehouseIdRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAll()
    {
        $result = $this->productService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->productService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->productService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->productService->update($request->validated());

        return response()->json($result, $result['status']);
    }

    public function getProductsByWarehouseId(ProductsByWarehouseIdRequest $request): object
    {
        $result = $this->productService->getProductsByWarehouseId($request->validated());

        return response()->json($result, $result['status']);
    }

    public function getAllRecordsOfProductById(GetAllRecordsOfProductByIdRequest $request)
    {
        $result = $this->productService->getAllRecordsOfProductById($request->validated());

        return response()->json($result, $result['status']);
    }
}
