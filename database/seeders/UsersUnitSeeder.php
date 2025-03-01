<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_units')->insert(array(
            array(
                'user_id' => 1,
                'unit_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'user_id' => 2,
                'unit_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
    }
}
