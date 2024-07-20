<?php

namespace Database\Factories;

use App\Models\FileRequestDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileRequestDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FileRequestDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'file_id' => 1,
            'request_detail_id' => 1,
        ];
    }
}
