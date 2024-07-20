<?php

namespace Database\Factories;

use App\Models\RequestDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequestDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'request_id' => 1,
            'product_id' => 1,
            'status_id' => 1,
            'delivery_id' => 1,
            'warehouses_id' => 1,
            'warehouse_delivery_id' => 1,
            'amount' => 1,
            'location' => null,
            'center_id' => null,
            'item_consumption_type_id' => null,
            'center3_id' => null,
            'return_delivery_id' => null,
            'return_user_id' => null,
            'returned' => null,
            'edited' => null,
            'not_exist' => null,
            'old_request_id' => 1,
            'changed_product' => null,
            'worn' => 0,
            'worn_amount' => null,
            'delivered' => null,
            'has_remittance' => null,
            'descriptions' => $this->faker->text,
        ];
    }
}
