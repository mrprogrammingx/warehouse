<?php

namespace App\Repositories;

use App\Models\Vehicle;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class VehicleRepository.
 */
class VehicleRepository
{
    public function getAll(){
        return Vehicle::all();
    }

    public function store(array $data){
        return Vehicle::create([
            'name' => $data['name'],
            'number' => $data['number'],
            'description' => $data['description']
        ]);
    }

    public function delete($id){
        return Vehicle::destroy($id);
    }

    public function update(array $data){
        return Vehicle::where([
            'id' => $data['id']
        ])->update([
            'name' => $data['name'],
            'number' => $data['number'],
            'description' => $data['description']
        ]);
    }
}
