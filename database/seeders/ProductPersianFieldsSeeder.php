<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPersianFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_persian_fields')->insert(array(
            array(
                'english_name' => 'ItemDataId',
                'persian_name' => 'Code',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'english_name' => 'IsInactive',
                'persian_name' => 'Inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'english_name' => 'Name',
                'persian_name' => 'Title',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'english_name' => 'NameEN',
                'persian_name' => 'Latin Title',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'english_name' => 'UnitId',
                'persian_name' => 'Unit',
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
    }
}
