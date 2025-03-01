<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuysDetail\StoreRequest;
use App\Http\Requests\BuysDetail\UpdateRequest;
use App\Services\BuysDetailService;
use Illuminate\Http\Request;

class BuysDetailController extends Controller
{
    protected $buysDetailService;

    public function __construct(BuysDetailService $buysDetailService)
    {
        $this->buysDetailService = $buysDetailService;
    }

    public function getAll()
    {
        $result = $this->buysDetailService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->buysDetailService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->buysDetailService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->buysDetailService->update($request->validated());

        return response()->json($result, $result['status']);
    }
}
