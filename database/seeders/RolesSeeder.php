<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'deliverer-admin']);
        Role::create(['name' => 'deliverer']);
        Role::create(['name' => 'warehouse-admin']);
        Role::create(['name' => 'warehouse-deliverer']);
        Role::create(['name' => 'warehouse']);
        Role::create(['name' => 'kargozini-admin']);
        Role::create(['name' => 'kargozini']);
        Role::create(['name' => 'client']);
    }
}
