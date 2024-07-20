<?php

namespace Database\Factories;

use App\Models\Confirm;
use App\Models\RequestsDetailsConfirm;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestsDetailsConfirmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequestsDetailsConfirm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'requests_detail_id' => 1,
            'confirm_id' => Confirm::max('id') +1 ,
            'user_id' => 1,
            'confirmed' => 1,
            'description' => $this->faker->text,
        ];
    }
}
