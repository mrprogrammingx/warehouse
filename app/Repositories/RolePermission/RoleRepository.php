<?php

namespace App\Repositories\RolePermission;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class RoleRepository.
 */
class RoleRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Role::class;
    }

    public function getAllRoles()
    {
        return $this->model()::with('permissions')->get();
    }

    public function assignPermissionToRole(array $data)
    {
        $role = $this->model()::findByName($data['roleName']);
        return $role->givePermissionTo($data['permissionName']);
    }
}
