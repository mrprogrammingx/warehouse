<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(array(
            array(
                'id' => 1,
                'name' => "Product number one",
                'Attributes' => '1',
                'worn' => '1',
                'descriptions' => 'The product is breakable',
                'file_id' => '1',
                'category_id' => '1',
                'rayvarz_id' => '1100',
                'technical_index_id' => '11',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 2,
                'name' => "Product number two",
                'Attributes' => '2',
                'worn' => '1',
                'descriptions' => 'The product is breakable',
                'file_id' => '1',
                'category_id' => '1',
                'rayvarz_id' => '1101',
                'technical_index_id' => '111',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'id' => 3,
                'name' => "Product number three",
                'Attributes' => '3',
                'worn' => '1',
                'descriptions' => 'The product is breakable',
                'file_id' => '1',
                'category_id' => '1',
                'rayvarz_id' => '1102',
                'technical_index_id' => '1111',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            ));
    }
}
