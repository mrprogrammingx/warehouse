<?php

namespace App\Repositories;

use App\Interfaces\GlobalVariablesInterface;
use App\Models\WarehouseDelivery;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class WarehouseDeliveryRepository.
 */
class WarehouseDeliveryRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return WarehouseDelivery::class;
    }

    public function getAll()
    {
        return $this->model()::all();
    }

    public function store(array $data)
    {
        return $this->model()::create([
            'user_id' => $data['user_id'],
            'active' => GlobalVariablesInterface::WAREHOUSE_DELIVERY_ACTIVE_DEFAULT,
        ]);
    }

    public function delete($id)
    {
        return $this->model()::destroy($id);
    }

    public function update(array $data)
    {
        return $this->model()::where([
            'id' => $data['id']
        ])->update([
            'user_id' => $data['user_id'],
            'active' => $data['active'],
        ]);
    }
}
