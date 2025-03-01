<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\buy\StoreRequest;
use App\Http\Requests\buy\UpdateRequest;
use App\Services\BuyService;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    protected $buyService;
    public function __construct(BuyService $buyService)
    {
        $this->buyService = $buyService;
    }

    public function getAll()
    {
        $result = $this->buyService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->buyService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->buyService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->buyService->update($request->validated());

        return response()->json($result, $result['status']);
    }

}
