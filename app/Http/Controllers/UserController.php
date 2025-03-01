<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\GetByIdRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateOrStoreByPersonnelCodeRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function getAll()
    {
        $result = $this->userService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->userService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->userService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->userService->update($request->validated());

        return response()->json($result, $result['status']);
    }

    public function getById(GetByIdRequest $request)
    {
        $result = $this->userService->getById($request->validated());

        return response()->json($result, $result['status']);
    }

    public function updateOrStoreByPersonnelCode(UpdateOrStoreByPersonnelCodeRequest $request)
    {
        Log::info($request->validated());

        $result = $this->userService->updateOrStoreByPersonnelCode($request->validated());

        return response()->json($result, $result['status']);
    }

    public function changeUserStatus(Request $request)
    {
        $result = $this->userService->changeUserStatus($request);

        return response()->json($result, $result['status']);
    }
}
