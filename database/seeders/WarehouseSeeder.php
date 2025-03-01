<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warehouses')->insert(
            array(
                array(
                    'rayvarz_id' => 10,
                    'active' => true,
                    'name' => '	Central Raw Material Warehouse',
                    'created_at' => now(),
                    'updated_at' => now(),
                ), array(
                    'rayvarz_id' => 100,
                    'active' => false,
                    'name' => 'Common customs rack warehouse',
                    'created_at' => now(),
                    'updated_at' => now(),
                ), array(
                    'rayvarz_id' => 101,
                    'active' => false,
                    'name' => '	Gethin warehouse',
                    'created_at' => now(),
                    'updated_at' => now(),
                ), array(
                    'rayvarz_id' => 102,
                    'active' => false,
                    'name' => 'Shahid Bahonar customs warehouse',
                    'created_at' => now(),
                    'updated_at' => now(),
                ), array(
                    'rayvarz_id' => 103,
                    'active' => false,
                    'name' => 'Shahid Rajaei customs warehouse',
                    'created_at' => now(),
                    'updated_at' => now(),
                )
            )

        );
    }
}
