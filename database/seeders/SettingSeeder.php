<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(array(
            'key' => 'last_rayvarz_product_index',
            'value' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ));
    }
}
