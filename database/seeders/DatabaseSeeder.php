<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call([
            FileCategorySeeder::class,
            UserSeeder::class,
            WarehouseSeeder::class,
            StatusSeeder::class,
            UnitSeeder::class,
            ConfirmSeeder::class,
            DeliverySeeder::class,
            VehicleSeeder::class,
            UsersUnitSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
            RolesPermissionsSeeder::class,
            CategorySeeder::class,
            SettingSeeder::class,
            //ProductSeeder::class,
            CenterSeeder::class,
            ProductPersianFieldsSeeder::class,
            ItemConsumptionTypesSeeder::class,
            Center3Seeder::class,
        ]);
    }
}
