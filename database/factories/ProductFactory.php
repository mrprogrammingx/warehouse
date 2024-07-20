<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'attributes' => 1,
            'worn' => 1,
            'descriptions' => $this->faker->text(),
            'file_id' => 1,
            'category_id' => 1,
            'rayvarz_id' => 1100,
            'technical_index_id' => 134,
        ];
    }
}
