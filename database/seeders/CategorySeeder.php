<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            array(
                array(
                    'rayvarz_id' => 1001,
                    'name' => 'Minerals',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
                array(
                    'rayvarz_id' => 3003009,
                    'name' => 'Shovel accessories',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),

                array(
                    'rayvarz_id' => 3004001,
                    'name' => 'Straps',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
                array(
                    'rayvarz_id' => 3005003,
                    'name' => '	resistors – capacitor circuits ',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
                array(
                    'rayvarz_id' => 3016001,
                    'name' => '	precision instrument spare parts',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            )

        );
    }
}
