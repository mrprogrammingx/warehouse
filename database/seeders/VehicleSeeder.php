<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert(array(
            array(
                'name' => 'MotorCycle',
                'number' => "24/3645",
                'description' => '2019 - Color:Red',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'name' => 'Car',
                'number' => "12BB567",
                'description' => '2018 - Color:White',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            ));

    }
}
