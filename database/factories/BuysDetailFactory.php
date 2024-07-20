<?php

namespace Database\Factories;

use App\Models\BuysDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuysDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuysDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'buy_id' => 1,
            'product_id' => 1,
            'status_id' => 1,
            'file_id' => 1,
            'delivery_id' => 1,
            'amount' => 1,
            'worn' => 1,
            'confirmed' => 1,
            'descriptions' => $this->faker->text(),
        ];
    }
}
