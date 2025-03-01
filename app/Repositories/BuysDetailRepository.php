<?php

namespace App\Repositories;

use App\Models\BuysDetail;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class BuysDetailRepository.
 */
class BuysDetailRepository
{
    public function getAll(){
        return BuysDetail::all();
    }

    public function store($data){
        return BuysDetail::create([
            'buy_id' => $data['buy_id'],
            'product_id' => $data['product_id'],
            'status_id' => $data['status_id'],
            'file_id' => $data['file_id'],
            'delivery_id' => $data['delivery_id'],
            'amount' => $data['amount'],
            'worn' => $data['worn'],
            'confirmed' => $data['confirmed'],
            'descriptions' => $data['descriptions'],
        ]);
    }

    public function delete($id){
        return BuysDetail::destroy($id);
    }

    public function update($data){
        return BuysDetail::where([
            'id' => $data['id']
        ])->update([
            'buy_id' => $data['buy_id'],
            'product_id' => $data['product_id'],
            'status_id' => $data['status_id'],
            'file_id' => $data['file_id'],
            'delivery_id' => $data['delivery_id'],
            'amount' => $data['amount'],
            'worn' => $data['worn'],
            'confirmed' => $data['confirmed'],
            'descriptions' => $data['descriptions'],
        ]);
    }
}
