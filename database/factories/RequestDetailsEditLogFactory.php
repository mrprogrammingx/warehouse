<?php

namespace Database\Factories;

use App\Models\RequestDetailsEditLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestDetailsEditLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequestDetailsEditLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'requests_details_id' => 1,
            'user_id' => 1,
            'flag' => 1,
            'request_id' => 1,
            'product_id' => 1,
            'status_id' => 1,
            'delivery_id' => 1,
            'warehouses_id' => 1,
            'warehouse_delivery_id' => 1,
            'amount' => 1,
            'location' => 0,
            'center_id' => 1,
            'worn' => 1,
            'worn_amount' => 1,
            'delivered' => 1,
            'has_remittance' => 0,
            'descriptions' => $this->faker->text,
        ];
    }
}
