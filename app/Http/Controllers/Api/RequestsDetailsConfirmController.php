<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestsDetailsConfirm\GetByRequestIdRequest;
use App\Http\Requests\RequestsDetailsConfirm\GetByRequestsDetailIdRequest;
use App\Http\Requests\RequestsDetailsConfirm\StoreRequest;
use App\Http\Requests\RequestsDetailsConfirm\UpdateByRequestDetailUserConfirmIdRequest;
use App\Http\Requests\RequestsDetailsConfirm\UpdateRequest;
use App\Services\RequestsDetailsConfirmService;

class RequestsDetailsConfirmController extends Controller
{
    protected $requestsDetailsConfirmService;
    public function __construct(RequestsDetailsConfirmService $requestsDetailsConfirmService)
    {
        $this->requestsDetailsConfirmService = $requestsDetailsConfirmService;
    }

    public function getAll()
    {
        $result = $this->requestsDetailsConfirmService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->requestsDetailsConfirmService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->requestsDetailsConfirmService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->requestsDetailsConfirmService->update($request->validated());

        return response()->json($result, $result['status']);
    }

    public function confirmsOfRequestDetail(GetByRequestsDetailIdRequest $request)
    {
        $result = $this->requestsDetailsConfirmService->confirmsOfRequestDetail($request->validated());

        return response()->json($result, $result['status']);
    }

    public function confirmsOfRequest(GetByRequestIdRequest $request)
    {
        $result = $this->requestsDetailsConfirmService->confirmsOfRequest($request->validated());

        return response()->json($result, $result['status']);
    }

    public function updateByRequestDetailIdUserIdAndConfirmId(UpdateByRequestDetailUserConfirmIdRequest $request)
    {
        $result = $this->requestsDetailsConfirmService->updateByRequestDetailIdUserIdAndConfirmId($request->validated());

        return response()->json($result, $result['status']);
    }
}
