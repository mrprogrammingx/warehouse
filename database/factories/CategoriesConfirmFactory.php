<?php

namespace Database\Factories;

use App\Models\CategoriesConfirm;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriesConfirmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoriesConfirm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => 1,
            'confirm_id' => 1
        ];
    }
}
