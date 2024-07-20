<?php

namespace Database\Factories;

use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'status_id' => 1,
            'unit_id' => 1,
            'request_number' => 1234,
            'validated_code' => 12345,
            'has_remittance' => 1,
            'descriptions' => $this->faker->text,
        ];
    }
}
