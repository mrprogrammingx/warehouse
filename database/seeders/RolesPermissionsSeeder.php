<?php

namespace Database\Seeders;

use App\Interfaces\RolePermissionInterface;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole=Role::findByName('super-admin');
        $allPermissions= Permission::all();
        $superAdminRole->syncPermissions($allPermissions);
        
        $user = User::where('personnel_code','3276')->first();
        $user->assignRole($superAdminRole->name);

        $user = User::where('personnel_code','5240')->first();
        $user->assignRole($superAdminRole->name);

        $user = User::where('personnel_code','4847')->first();
        $user->assignRole($superAdminRole->name);

        $adminRole=Role::findByName('admin');
        $adminPermissions = Permission::whereNotIn('name',RolePermissionInterface::PERMISSIONS_HAS_NOT_ADMIN)->get();
        $adminRole->syncPermissions($adminPermissions);

        $user = User::where('personnel_code','1234')->first();
        $user->assignRole($adminRole->name);

        $clientRole=Role::findByName('client');
        $clientPermissions = Permission::whereIn('name',RolePermissionInterface::PERMISSIONS_FOR_CLIENT)->get();
        $clientRole->syncPermissions($clientPermissions);

        $user = User::where('personnel_code','3232')->first();
        $user->assignRole($clientRole->name);

        $delivererAdminRole=Role::findByName('deliverer-admin');
        $delivererAdminPermissions = Permission::whereNotIn('name',RolePermissionInterface::PERMISSIONS_HAS_NOT_DELIVERER_ADMIN)->get();
        $delivererAdminRole->syncPermissions($delivererAdminPermissions);

        $delivererRole=Role::findByName('deliverer');
        $delivererPermissions = Permission::whereIn('name',RolePermissionInterface::PERMISSIONS_FOR_DELIVERER)->get();
        $delivererRole->syncPermissions($delivererPermissions);

        $warehouseAdminRole=Role::findByName('warehouse-admin');
        $warehouseAdminPermissions = Permission::whereNotIn('name',RolePermissionInterface::PERMISSIONS_HAS_NOT_WAREHOUSE_ADMIN)->get();
        $warehouseAdminRole->syncPermissions($warehouseAdminPermissions);

        $warehouseDelivererRole=Role::findByName('warehouse-deliverer');
        $warehouseDelivererPermissions = Permission::whereNotIn('name',RolePermissionInterface::PERMISSIONS_HAS_NOT_WAREHOUSE_DELIVERER)->get();
        $warehouseDelivererRole->syncPermissions($warehouseDelivererPermissions);

        $warehouseRole=Role::findByName('warehouse');
        $warehousePermissions = Permission::whereIn('name',RolePermissionInterface::PERMISSIONS_FOR_WAREHOUSE)->get();
        $warehouseRole->syncPermissions($warehousePermissions);

    }
}
