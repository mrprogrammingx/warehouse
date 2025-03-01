<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Status\StoreRequest;
use App\Http\Requests\Status\UpdateRequest;
use App\Services\StatusService;

class StatusController extends Controller
{
    protected $statusService;
    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
        $this->middleware('permission:status-list|status-store|status-update|status-delete', ['only' => ['getAll']]);
        $this->middleware('permission:status-store', ['only' => ['store']]);
        $this->middleware('permission:status-delete', ['only' => ['delete']]);
        $this->middleware('permission:status-update', ['only' => ['update']]);
    }

    public function getAll()
    {
        $result = $this->statusService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->statusService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete($id)
    {
        $result = $this->statusService->delete($id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->statusService->update($request->validated());

        return response()->json($result, $result['status']);
    }
}
