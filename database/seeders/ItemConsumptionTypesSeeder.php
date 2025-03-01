<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemConsumptionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_consumption_types')->insert(array(
            array(
                'rayvarz_id' => 1,
                'name' => 'For sale',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'rayvarz_id' => 2,
                'name' => 'Amani Rak',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'rayvarz_id' => 3,
                'name' => 'For production / packaging',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'rayvarz_id' => 4,
                'name' => 'For the Gawarah',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'rayvarz_id' => 5,
                'name' => 'For conversions',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            ));
    }
}
