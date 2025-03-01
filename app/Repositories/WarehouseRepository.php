<?php

namespace App\Repositories;

use App\Models\Warehouse;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class WarehouseRepository.
 */
class WarehouseRepository
{
    public function getAll()
    {
        return Warehouse::all();
    }

    public function store(array $data)
    {
        return Warehouse::create([
            'name' => $data['name'],
        ]);
    }

    public function delete($id)
    {
        return Warehouse::destroy($id);
    }

    public function update(array $data)
    {
        return Warehouse::where([
            'id' => $data['id']
        ])->update([
            'name' => $data['name'],
        ]);
    }

    public function getAllActiveWarehouses()
    {
        return Warehouse::where([
            'active' => true,
        ])->get();
    }
}
