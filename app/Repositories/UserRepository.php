<?php

namespace App\Repositories;

use App\Models\User;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository
{
    public function getAll()
    {
        return User::with('usersUnit.unit')->get();
    }

    public function store(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'mobile' => $data['mobile'] ?? null,
            'user_name' => $data['user_name'] ?? null,
            'personnel_code' =>  $data['personnel_code'] ?? null,
            'password' => bcrypt($data['password']),
        ]);
    }

    public function delete(int $id)
    {
        return User::destroy($id);
    }

    public function update(array $data)
    {
        return User::where([
            'id' => $data['id']
        ])->update([
            'first_name' => $data['first_name'],
            'mobile' => $data['mobile'],
            'last_name' => $data['last_name'],
            'user_name' => $data['user_name'],
            'personnel_code' =>  $data['personnel_code'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getById(int $id)
    {
        return User::with('usersUnit.unit')->find($id);
    }

    public function personnelCodeExists(int $personnelCode): bool
    {
        return User::where('personnel_code', $personnelCode)->exists();
    }

    public function updateOrStoreByPersonnelCode(array $data)
    {
        return User::updateOrCreate(
            [
                'personnel_code' => $data['personnel_code']
            ],
            [
                'first_name' => $data['first_name'] ?? null,
                'last_name' => $data['last_name'] ?? null,
                'mobile' => $data['mobile'] ?? null,
                'user_name' => $data['user_name'] ?? null,
                'password' => bcrypt($data['password']),
            ],
        );
    }

    public function changeUserStatus($request) {
        $user = User::where('personnel_code',$request->personnel_code)->first();
        $user->active == false ? $user->active = true  : $user->active = false;
        $user->save();
        return $user;
    }

    public function getLoginUserPermissions()
    {
        return true;
    }
}
