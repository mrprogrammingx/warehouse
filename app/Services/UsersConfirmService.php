<?php

namespace App\Services;

use App\Models\UsersConfirm;
use App\Repositories\UsersConfirmRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class UsersConfirmService
 * @package App\Services
 */
class UsersConfirmService
{
    protected $usersConfirmRepository;
    public function __construct(UsersConfirmRepository $usersConfirmRepository)
    {
        $this->usersConfirmRepository = $usersConfirmRepository;
    }

    public function getAll():array
    {
        return ResponsesService::success($this->usersConfirmRepository->getAll());
    }

    public function store(array $data):array
    {
        return ($this->usersConfirmRepository->checkIsNotRepetitious($data)) ? ResponsesService::error(null, 'The confirmation has already been registered for the user!') : ResponsesService::success($this->usersConfirmRepository->store($data));
    }

    public function delete(int $id):array
    {
        return ResponsesService::success($this->usersConfirmRepository->delete($id));
    }

    public function update(array $data):array
    {
        return ResponsesService::success($this->usersConfirmRepository->update($data));
    }

    public function getByUserId(array $data):array
    {
        return ResponsesService::success($this->usersConfirmRepository->getByUserId($data['userId'] ?? UserService::getUserId()));
    }

    public function setInactiveStatusByUserConfirmId(array $data):array
    {
        return ResponsesService::success($this->usersConfirmRepository->setInactiveStatusByUserConfirmId($data['userConfirmId']));
    }
}
