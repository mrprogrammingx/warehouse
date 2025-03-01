<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesConfirm\StoreRequest;
use App\Http\Requests\CategoriesConfirm\UpdateRequest;
use App\Services\CategoriesConfirmService;
use Illuminate\Http\Request;

class CategoriesConfirmController extends Controller
{
    protected $categoriesConfirmService;

    public function __construct(CategoriesConfirmService $categoriesConfirmService)
    {
        $this->categoriesConfirmService = $categoriesConfirmService;
    }

    public function getAll()
    {
        $result = $this->categoriesConfirmService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->categoriesConfirmService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->categoriesConfirmService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->categoriesConfirmService->update($request->validated());

        return response()->json($result, $result['status']);
    }

}
