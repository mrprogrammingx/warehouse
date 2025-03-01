<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveries')->insert(array(
            array(
                'user_id' => 1,
                'vehicle_id' => 1,
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            )
            )
        );
    }
}
