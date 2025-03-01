<?php

namespace App\Services;

use App\Repositories\CategoriesConfirmRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class CategoriesConfirmService
 * @package App\Services
 */
class CategoriesConfirmService
{
    protected $categoriesConfirmRepository;
    public function __construct(CategoriesConfirmRepository $categoriesConfirmRepository)
    {
        $this->categoriesConfirmRepository = $categoriesConfirmRepository;
    }

    public function getAll(){
        return ResponsesService::success($this->categoriesConfirmRepository->getAll());
    }

    public function store(array $data){
        return ($this->categoriesConfirmRepository->checkIsNotRepetitious($data)) ? ResponsesService::error(null , 'This type of confirmation has already been registered for this category!') : ResponsesService::success($this->categoriesConfirmRepository->store($data));
    }

    public function delete(int $id){
        return ResponsesService::success($this->categoriesConfirmRepository->delete($id));
    }

    public function update(array $data){
        return ResponsesService::success($this->categoriesConfirmRepository->update($data));
    }

}
