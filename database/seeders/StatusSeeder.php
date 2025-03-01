<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(array(
            array(
                'id' => 1,
                'name' => 'Initial request',
                'title' => 'Initial request',
                'priority' => 1,
                'description' => 'Initial request',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 2,
                'name' => 'Getting permissions',
                'title' => 'Getting permissions',
                'priority' => 2,
                'description' => 'Getting permissions',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 3,
                'name' => 'Cartable Courier',
                'title' =>  'Cartable Courier',
                'priority' => 3,
                'description' => 'Cartable Courier',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 4,
                'name' => 'Courier delivery',
                'title' => 'Courier delivery',
                'priority' => 4,
                'description' => 'Courier delivery',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 5,
                'name' => 'Back to warehouse',
                'title' => 'Back to warehouse',
                'priority' => 5,
                'description' => 'Back to warehouse',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 6,
                'name' => 'Canceled',
                'title' => 'Canceled',
                'priority' => 6,
                'description' => 'Canceled',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 7,
                'name' => 'Archived',
                'title' => 'Archived',
                'priority' => 7,
                'description' => 'Archived',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            )
        );
    }
}
