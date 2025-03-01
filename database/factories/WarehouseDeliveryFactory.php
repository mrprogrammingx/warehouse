<?php

namespace Database\Factories;

use App\Interfaces\GlobalVariablesInterface;
use App\Models\WarehouseDelivery;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseDeliveryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WarehouseDelivery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'active' => GlobalVariablesInterface::WAREHOUSE_DELIVERY_ACTIVE_DEFAULT,
        ];
    }
}
