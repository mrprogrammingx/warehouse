<?php

namespace Database\Factories;

use App\Models\ProductsConfirm;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsConfirmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductsConfirm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'confirm_id' => 1,
            'product_id' => 1,
        ];
    }
}
