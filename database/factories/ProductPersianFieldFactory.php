<?php

namespace Database\Factories;

use App\Models\ProductPersianField;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPersianFieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductPersianField::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'english_name' => 'test',
            'persian_name' => 'تست',
        ];
    }
}
