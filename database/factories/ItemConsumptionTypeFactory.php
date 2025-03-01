<?php

namespace Database\Factories;

use App\Models\ItemConsumptionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemConsumptionTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemConsumptionType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'rayvarz_id' => 1,
            'active' => 0,
        ];
    }
}
