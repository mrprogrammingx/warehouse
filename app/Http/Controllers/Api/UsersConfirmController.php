<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserConfirm\GetByUserIdRequest;
use App\Http\Requests\UserConfirm\SetActiveStatusUserConfirmIdRequest;
use App\Http\Requests\UserConfirm\StoreRequest;
use App\Http\Requests\UserConfirm\UpdateRequest;
use App\Services\UsersConfirmService;
use Illuminate\Http\Request;

class UsersConfirmController extends Controller
{
    protected $usersConfirmService;
    public function __construct(UsersConfirmService $usersConfirmService)
    {
        $this->usersConfirmService = $usersConfirmService;
    }
    public function getAll()
    {
        $result = $this->usersConfirmService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->usersConfirmService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->usersConfirmService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->usersConfirmService->update($request->validated());

        return response()->json($result, $result['status']);
    }

    public function getByUserId(GetByUserIdRequest $request)
    {
        $result = $this->usersConfirmService->getByUserId($request->validated());

        return response()->json($result, $result['status']);
    }

    public function setInactiveStatusByUserConfirmId(SetActiveStatusUserConfirmIdRequest $request)
    {
        $result = $this->usersConfirmService->setInactiveStatusByUserConfirmId($request->validated());

        return response()->json($result, $result['status']);
    }
}
