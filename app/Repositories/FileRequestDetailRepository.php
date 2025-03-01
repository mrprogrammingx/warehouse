<?php

namespace App\Repositories;

use App\Models\FileRequestDetail;
use App\Repositories\Globals\fieldRepository;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class FileRequestDetailRepository.
 */
class FileRequestDetailRepository
{
    public function getAll(){
        return FileRequestDetail::all();
    }

    public function store($data){
        $fields = fieldRepository::tableFields($data,$table='file_request_details');
        return FileRequestDetail::create($fields);
    }

    public function fileIdExist($id){
        return FileRequestDetail::where([
            'file_id' => $id
        ])->exists();
    }
}
