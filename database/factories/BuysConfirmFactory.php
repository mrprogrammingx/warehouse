<?php

namespace Database\Factories;

use App\Models\BuysConfirm;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuysConfirmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuysConfirm::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'buys_detail_id' => 1,
            'confirm_id' => 1,
            'user_id' => 1,
            'confirmed' => null,
        ];
    }
}
