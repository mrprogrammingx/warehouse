<?php

namespace Database\Factories;

use App\Models\ChangedStatusLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChangedStatusLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChangedStatusLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'request_id' => 1,
            'status_id' => 1,
            'user_id' => 1
        ];
    }
}
