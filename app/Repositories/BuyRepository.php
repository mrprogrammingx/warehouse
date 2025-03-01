<?php

namespace App\Repositories;

use App\Models\Buy;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BuyRepository.
 */
class BuyRepository
{
    public function getAll(){
        return Buy::all();
    }

    public function store($data){
        return Buy::create([
            'user_id' => $data['user_id'],
            'status_id' => $data['status_id'],
            'unit_id' => $data['unit_id'],
            'confirmed' => $data['confirmed'],
            'descriptions' => $data['descriptions'],
        ]);
    }

    public function delete($id){
        return Buy::destroy($id);
    }

    public function update($data){
        return Buy::where([
            'id' => $data['id'],
        ])->update([
            'user_id' => $data['user_id'],
            'status_id' => $data['status_id'],
            'unit_id' => $data['unit_id'],
            'confirmed' => $data['confirmed'],
            'descriptions' => $data['descriptions'],
        ]);
    }

}
