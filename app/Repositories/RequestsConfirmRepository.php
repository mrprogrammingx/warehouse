<?php

namespace App\Repositories;

use App\Models\RequestsConfirm;
use App\Repositories\Globals\fieldRepository;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class RequestsConfirmRepository.
 */
class RequestsConfirmRepository
{
    public function getAll(){
        return RequestsConfirm::all();
    }

    public function store($data){
        $fields = fieldRepository::tableFields($data,$table='requests_confirms');
        return RequestsConfirm::create($fields);
    }

    public function delete($id){
        return RequestsConfirm::destroy($id);
    }

    public function update($data){
        $fields = fieldRepository::tableFields($data,$table='requests_confirms');
        return RequestsConfirm::where([
            'id' => $data['id']
        ])->update($fields);
    }

    public function getRequestsByDeliveryId($userId){
        return RequestsConfirm::where([
            'user_id' => $userId
        ])->get();
    }
}
