<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Center3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('center3s')->insert(
            array(
                array(
                    'rayvarz_id' => 0,
                    'name' => 'test',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            )
        );
    }
}
