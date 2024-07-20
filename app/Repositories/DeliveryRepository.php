<?php

namespace App\Repositories;

use App\Models\Delivery;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class DeliveryRepository
{
    public function getAll()
    {
        return Delivery::with('user', 'vehicle')->get();
    }

    public function store($data)
    {
        return Delivery::create([
            'user_id' => $data['user_id'],
            'vehicle_id' => $data['vehicle_id'],
            'active' => $data['active'],
            'online' => $data['online'],
        ]);
    }

    public function delete($id)
    {
        return Delivery::destroy($id);
    }

    public function update($data)
    {
        return Delivery::where([
            'id' => $data['id']
        ])->update([
            'user_id' => $data['user_id'],
            'vehicle_id' => $data['vehicle_id'],
            'active' => $data['active'],
            'online' => $data['online'],
        ]);
    }

    public function updateOnlineStatus($data)
    {
        return Delivery::where([
            'id' => $data['id']
        ])->update([
            'online' => $data['online'],
        ]);
    }

    public function deliveryExists(array $data): bool
    {
        return Delivery::where([
            'user_id' => $data['user_id'],
            'vehicle_id' => $data['vehicle_id'],
        ])->exists();
    }

    public function getDeliveryByUserId(int $userId)
    {
        return Delivery::where([
            'user_id' => $userId,
        ])->get();
    }

    public function checkVehicleExist(int $id):bool
    {
        return Delivery::where([
            'id' => $id
        ])->exists();
    }
}
