<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BuysConfirmService;
use App\Http\Requests\buysConfirm\StoreRequest;
use App\Http\Requests\buysConfirm\UpdateRequest;

class BuysConfirmController extends Controller
{
    protected $buysConfirmService;
    public function __construct(BuysConfirmService $buysConfirmService)
    {
        $this->buysConfirmService = $buysConfirmService;
    }

    public function getAll()
    {
        $result = $this->buysConfirmService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->buysConfirmService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->buysConfirmService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->buysConfirmService->update($request->validated());

        return response()->json($result, $result['status']);
    }
}
