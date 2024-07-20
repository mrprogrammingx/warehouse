<?php

namespace App\Repositories;

use App\Interfaces\GlobalVariablesInterface;
use App\Models\RequestsDetailsConfirm;
use App\Repositories\Globals\fieldRepository;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class RequestsDetailsConfirmRepository.
 */
class RequestsDetailsConfirmRepository
{
    public function getAll()
    {
        return RequestsDetailsConfirm::all();
    }

    public function store($data)
    {
        $fields = fieldRepository::tableFields($data, $table = 'requests_details_confirms');
        return RequestsDetailsConfirm::firstOrCreate($fields,$data);
    }

    public function delete($id)
    {
        return RequestsDetailsConfirm::destroy($id);
    }

    public function update($data)
    {
        $fields = fieldRepository::tableFields($data, $table = 'requests_details_confirms');
        return RequestsDetailsConfirm::where([
            'id' => $data['id']
        ])->update($fields);
    }

    public function getRequestsDetailsByConfirmUserId($userId)
    {
        return RequestsDetailsConfirm::where([
            'user_id' => $userId
        ])->get();
    }

    public function confirmsOfRequestDetail($requests_detail_id)
    {
        return RequestsDetailsConfirm::with('confirm','user')->where([
            'requests_detail_id' => $requests_detail_id
        ])->get();
    }

    public function confirmsOfRequestDetails(array $requests_detail_ids)
    {
        return RequestsDetailsConfirm::with('confirm','user')->whereIn(
            'requests_detail_id' , $requests_detail_ids
        )->get();
    }

    public function updateByRequestDetailIdUserIdAndConfirmId(array $data){
        return RequestsDetailsConfirm::where([
            'id' => $data['requests_detail_confirm_id'],
            'requests_detail_id' => $data['requests_detail_id'],
            'confirm_id' => $data['confirm_id'],
        ])->update([
            'user_id' => $data['user_id'],
            'confirmed' => $data['confirmed'],
            'description' => $data['description'],
        ]);
    }

    public function confirmOfRequestDetailIsNull(array $requestDetailsId){
        return RequestsDetailsConfirm::whereIn(
            'requests_detail_id' , $requestDetailsId
        )->
        whereNull(
            'confirmed'
        )->
        whereHas(
            'request_details',
            function ($query) {
                $query->where('status_id' , '<>' , GlobalVariablesInterface::CANCEL_STEP);
            }
        )->
        exists();
    }

    public function confirmOfRequestDetailIsFalse(array $requestDetailsId, $notConfirmed = 0){
        return RequestsDetailsConfirm::whereIn(
            'requests_detail_id' , $requestDetailsId
        )->
        where(
            'confirmed' , $notConfirmed
        )->
        whereHas(
            'request_details',
            function ($query) {
                $query->where('status_id' , '<>' , GlobalVariablesInterface::CANCEL_STEP);
            }
        )->
        exists();
    }

    public function checkConfirmsIsUnique($requests_detail_id , $confirm_id , $user_id){
        return RequestsDetailsConfirm::whereIn(
            'requests_detail_id' , $requests_detail_id,
        )->whereIn(
            'confirm_id' , $confirm_id,
        )->whereIn(
            'user_id' , $user_id,
        )->doesntExist();
    }
    
}
