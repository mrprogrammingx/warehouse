<?php

namespace App\Repositories;

use App\Models\UsersConfirm;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UsersConfirmRepository.
 */
class UsersConfirmRepository
{
    public function getAll(): ?object
    {
        return UsersConfirm::with('user', 'confirm')->get();
    }

    public function store(array $data): ?object
    {
        return UsersConfirm::create([
            'user_id' => $data['user_id'],
            'confirm_id' => $data['confirm_id'],
        ]);
    }

    public function delete(int $id)
    {
        return UsersConfirm::destroy($id);
    }

    public function update(array $data): ?int
    {
        return UsersConfirm::where([
            'id' => $data['id']
        ])->update([
            'user_id' => $data['user_id'],
            'confirm_id' => $data['confirm_id'],
        ]);
    }

    public function getByUserId(int $userId): ?object
    {
        return UsersConfirm::with('user', 'confirm')->where([
            'user_id' => $userId
        ])->get();
    }

    public function checkIsNotRepetitious(array $data): ?bool
    {
        return UsersConfirm::where([
            'user_id' => $data['user_id'],
            'confirm_id' => $data['confirm_id'],
        ])->exists();
    }

    public function setInactiveStatusByUserConfirmId(int $id)
    {
        return UsersConfirm::where([
            'id' => $id
        ])->update([
            'active' => false 
        ]);
    }
}
