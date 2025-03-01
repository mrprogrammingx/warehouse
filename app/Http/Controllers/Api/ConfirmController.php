<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\confirm\StoreRequest;
use App\Http\Requests\confirm\UpdateRequest;
use App\Services\ConfirmService;
use Illuminate\Http\Request;

class ConfirmController extends Controller
{
    protected $confirmService;
    public function __construct(ConfirmService $confirmService)
    {
        $this->confirmService = $confirmService;
    }

    public function getAll()
    {
        $result = $this->confirmService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->confirmService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {

        $result = $this->confirmService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->confirmService->update($request->validated());

        return response()->json($result, $result['status']);
    }
}
