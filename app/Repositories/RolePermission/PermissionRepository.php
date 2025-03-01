<?php

namespace App\Repositories\RolePermission;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Permission;

//use Your Model

/**
 * Class PermissionRepository.
 */
class PermissionRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Permission::class;
    }

    public function getAllPermissions()
    {
        return $this->model()::all();
    }
}
