<?php

namespace App\Repositories;

use App\Models\MeasureUnit;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class MeasureUnitRepository.
 */
class MeasureUnitRepository
{
    public function getAll(){
        return MeasureUnit::all();
    }

    public function store($data){
        return MeasureUnit::create([
            'name' => $data['name'],
        ]);
    }

    public function delete($id){
        return MeasureUnit::destroy($id);
    }

    public function update($data){
        return MeasureUnit::where([
            'id' => $data['id']
        ])->update([
            'name' => $data['name'],
        ]);
    }
}
