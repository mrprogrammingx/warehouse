<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unit\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $unitService;
    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function getAll()
    {
        $result = $this->unitService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->unitService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->unitService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->unitService->update($request->validated());

        return response()->json($result, $result['status']);
    }
}
