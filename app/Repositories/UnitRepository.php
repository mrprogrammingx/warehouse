<?php

namespace App\Repositories;

use App\Models\Unit;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UnitRepository.
 */
class UnitRepository
{
    public function getAll(){
        return Unit::all();
    }

    public function store($data){
        return Unit::create([
            'name' => $data['name']
        ]);
    }

    public function delete($id){
        return Unit::destroy($id);
    }

    public function update($data){
        return Unit::where([
            'id' => $data['id']
        ])->update([
            'name' => $data['name']
        ]);
    }
    
}
