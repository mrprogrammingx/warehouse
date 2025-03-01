<?php

namespace App\Services;

use App\Repositories\BuyRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class BuyService
 * @package App\Services
 */
class BuyService
{
    protected $buyRepository;
    public function __construct(BuyRepository $buyRepository)
    {
        $this->buyRepository = $buyRepository;
    }

    public function getAll(){
        return ResponsesService::success($this->buyRepository->getAll());
    }

    public function store(array $data){
        return ResponsesService::success($this->buyRepository->store($data));
    }

    public function delete(int $id){
        return ResponsesService::success($this->buyRepository->delete($id));
    }

    public function update(array $data){
        return ResponsesService::success($this->buyRepository->update($data));
    }
    
}
