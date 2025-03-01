<?php

namespace Database\Factories;

use App\Models\RequestsConfirm;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestsConfirmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequestsConfirm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'request_id' => 1,
            'confirm_id' => 1,
            'user_id' => 1,
            'confirmed' => null,
        ];
    }
}
