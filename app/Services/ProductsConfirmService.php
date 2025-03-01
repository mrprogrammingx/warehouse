<?php

namespace App\Services;

use App\Repositories\ProductsConfirmRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class ProductsConfirmService
 * @package App\Services
 */
class ProductsConfirmService
{
    protected $productsConfirmRepository;
    public function __construct(ProductsConfirmRepository $productsConfirmRepository)
    {
        $this->productsConfirmRepository = $productsConfirmRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->productsConfirmRepository->getAll());
    }

    public function store(array $data)
    {
        return ($this->productsConfirmRepository->checkIsNotRepetitious($data)) ? ResponsesService::error(null, 'The confirmation has already been given to the product') : ResponsesService::success($this->productsConfirmRepository->store($data));
    }

    public function getByProductId(array $data)
    {
        return ResponsesService::success($this->productsConfirmRepository->getByProductId($data['product_id']));
    }
}
