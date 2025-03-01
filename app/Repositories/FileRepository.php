<?php

namespace App\Repositories;

use App\Models\File;
use App\Repositories\Globals\fieldRepository;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class FileRepository
{
    public function getAll(){
        return File::all();
    }

    public function store($data){
        $fields = fieldRepository::tableFields($data,$table='files');
        return File::create($fields);
    }

    public function delete($id){
        return File::destroy($id);
    }

    public function update($data){
        $fields = fieldRepository::tableFields($data,$table='files');
        return File::where([
            'id' => $data['id']
        ])->update($fields);
    }

    public function getById($id)
    {
        return File::find($id);
    }
}
