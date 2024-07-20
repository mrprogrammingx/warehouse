<?php

namespace Database\Factories;

use App\Models\WarehousesProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehousesProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WarehousesProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => 1,
            'warehouse_id' => 1,
            'amount' => 1,
            'measure_unit_id' => 1,
            'buy_request_atleast' => 1,
            'quorum' => 1,
        ];
    }
}
