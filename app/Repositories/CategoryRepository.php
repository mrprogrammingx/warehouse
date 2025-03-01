<?php

namespace App\Repositories;

use App\Models\Category;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CategoryRepository.
 */
class CategoryRepository
{
    public function getAll(){
        return Category::all();
    }

    public function store($data){
        return Category::create([
            'name' => $data['name']
        ]);
    }

    public function delete($id){
        return Category::destroy($id);
    }

    public function update($data){
        return Category::where([
            'id' => $data['id']
        ])->update([
            'name' => $data['name']
        ]);
    }
}
