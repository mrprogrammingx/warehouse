<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'filesCategory_id' => 1,
            'name' => $this->faker->name,
            'url' => '/',
            'file' => $this->faker->url,
            'user_id' => 1,
            'description' => $this->faker->text
        ];
    }
}
