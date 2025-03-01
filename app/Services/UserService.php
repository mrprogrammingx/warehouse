<?php

namespace App\Services;

use App\Interfaces\GlobalVariablesInterface;
use App\Interfaces\RolePermissionInterface;
use App\Models\User;
use App\Repositories\RolePermission\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\Globals\ResponsesService;
use App\Services\RolePermission\RoleService;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    protected $userRepository, $roleService;
    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->roleService = new RoleService();

    }

    public function getAll()
    {
        return ResponsesService::success($this->addRolesToUsers($this->userRepository->getAll()));
    }

    public function store(array $data)
    {
        $user = $this->userRepository->store($data);
        $this->roleService->addRoleToUser($info = [
            'role' => $data['roles'] ?? RolePermissionInterface::DEFAULT_ROLE,
            'userId' => $user->id,
        ]);
        return ResponsesService::success($user);
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->userRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->userRepository->update($data));
    }

    public static function getUserId()
    {
        return auth()->user()->id ?? GlobalVariablesInterface::DEFAULT_USER_ID;
    }

    public function getById(array $data)
    {
        return ResponsesService::success($this->userRepository->getById($data['id'] ?? $this->getUserId()));
    }

    public function addRolesToUsers(?object $users)
    {
        $usersWithRole = [];
        foreach ($users as $user) {
            $user->getRoleNames();
            array_push($usersWithRole, $user);
        }
        return $usersWithRole;
    }

    public function updateOrStoreByPersonnelCode(array $data)
    {
        foreach($data['data'] as $datum){
            $result[] = $this->userRepository->updateOrStoreByPersonnelCode($datum);
        }
        return ResponsesService::success($result);
    }

    public function getLoginUserPermissions() {
        return ResponsesService::success($this->userRepository->getLoginUserPermissions());

    }

    public function changeUserStatus($request) {
        if(is_null($request->personnel_code)) {
            return Response()->json(['message' =>  'The personnel not found','status' => '404'],404);
        }
        return ResponsesService::success($this->userRepository->changeUserStatus($request));

    }
}
