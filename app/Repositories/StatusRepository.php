<?php

namespace App\Repositories;

use App\Models\Status;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model


# Class StatusRepository.
class StatusRepository
{
    public function getAll(){
        return Status::all();
    }

    public function store($data){
        return Status::create([
            'name' => $data['name'],
            'title' => $data['title'],
            'priority' => $data['priority'] ?? '',
            'description' => $data['description'] ?? '',
        ]);
    }

    public function delete($id){
        return Status::destroy($id);
    }

    public function update($data){
        return Status::where([
            'id' => $data['id']
        ])->update([
            'name' => $data['name']
        ]);
    }
}
