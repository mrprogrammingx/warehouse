<?php

namespace App\Repositories;

use App\Models\BuysConfirm;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BuysConfirmRepository.
 */
class BuysConfirmRepository
{
    public function getAll(){
        return BuysConfirm::all();
    }

    public function store($data){
        return BuysConfirm::create([
            'buys_detail_id' => $data['buys_detail_id'],
            'confirm_id' => $data['confirm_id'],
            'user_id' => $data['user_id'],
            'confirmed' => $data['confirmed'],
        ]);
    }

    public function delete($id){
        return BuysConfirm::destroy($id);
    }

    public function update($data){
        return BuysConfirm::where([
            'id' => $data['id']
        ])->update([
            'buys_detail_id' => $data['buys_detail_id'],
            'confirm_id' => $data['confirm_id'],
            'user_id' => $data['user_id'],
            'confirmed' => $data['confirmed'],
        ]);
    }
}
