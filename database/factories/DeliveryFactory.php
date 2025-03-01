<?php

namespace Database\Factories;

use App\Models\Delivery;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Delivery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'vehicle_id' => Vehicle::max('id') + 1,
            'active' => 0,
            'online' => 0,
        ];
    }
}
