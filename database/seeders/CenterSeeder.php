<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('centers')->insert(array(
            array(
                'rayvarz_id' => 1100002,
                'name' => 'Homogenizer unit',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'rayvarz_id' => 1100003,
                'name' => 'Batch Plant Unit',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'rayvarz_id' => 1100004,
                'name' => 'Furnace unit',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'rayvarz_id' => 1100005,
                'name' => 'Tin bath unit',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'rayvarz_id' => 1100006,
                'name' => 'Lehr unit',
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
    }
}
