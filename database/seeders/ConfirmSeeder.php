<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfirmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('confirms')->insert(array(
            array(
                'id' => 1,
                'name' => 'Purchase confirmation',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 2,
                'name' => 'Delivery confirmation',
                'created_at' => now(),
                'updated_at' => now(),
            ),
                array(
                    'id' => 3,
                    'name' => 'Technical confirmation',
                    'created_at' => now(),
                    'updated_at' => now(),
                )
            )
        );
    }
}
