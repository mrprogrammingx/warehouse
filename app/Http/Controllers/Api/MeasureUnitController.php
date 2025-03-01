<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\measureUnit\StoreRequest;
use App\Http\Requests\measureUnit\UpdateRequest;
use App\Services\MeasureUnitService;

class MeasureUnitController extends Controller
{
    protected $measureUnitService;
    public function __construct(MeasureUnitService $measureUnitService)
    {
        $this->measureUnitService = $measureUnitService;
    }

    public function getAll()
    {
        $result = $this->measureUnitService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->measureUnitService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete($id)
    {
        $result = $this->measureUnitService->dalete($id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->measureUnitService->update($request->validated());

        return response()->json($result, $result['status']);
    }
}
