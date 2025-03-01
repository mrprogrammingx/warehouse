<?php

namespace Database\Factories;

use App\Models\UsersConfirm;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersConfirmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsersConfirm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'confirm_id' => 1,
        ];
    }
}
