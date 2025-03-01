<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\requestsConfirm\StoreRequest;
use App\Http\Requests\requestsConfirm\UpdateRequest;
use App\Services\RequestsConfirmService;

class RequestsConfirmController extends Controller
{
    protected $requestsConfirmService;
    public function __construct(RequestsConfirmService $requestsConfirmService)
    {
        $this->requestsConfirmService = $requestsConfirmService;
    }

    public function getAll()
    {
        $result = $this->requestsConfirmService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->requestsConfirmService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->requestsConfirmService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->requestsConfirmService->update($request->validated());

        return response()->json($result, $result['status']);
    }
}
