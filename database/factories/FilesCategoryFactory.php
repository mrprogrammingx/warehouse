<?php

namespace Database\Factories;

use App\Models\FilesCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilesCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FilesCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'link' => $this->faker->url,
        ];
    }
}
