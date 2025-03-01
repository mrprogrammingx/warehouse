<?php

namespace Database\Factories;

use App\Models\Center3;
use Illuminate\Database\Eloquent\Factories\Factory;

class Center3Factory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Center3::class;

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
            'active' => 1,
        ];
    }
}
