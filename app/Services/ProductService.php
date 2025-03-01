<?php

namespace App\Services;

use App\Repositories\ProductPersianFieldsRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RequestDetailRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    protected $productRepository, $productPersianFieldsRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->productPersianFieldsRepository = new ProductPersianFieldsRepository();
    }

    public function getAll(): array
    {
        return ResponsesService::success($this->productRepository->getAll());
    }

    public function store(array $data): array
    {
        return ResponsesService::success($this->productRepository->store($data));
    }

    public function delete(int $id): array
    {
        return ResponsesService::success($this->productRepository->delete($id));
    }

    public function update(array $data): array
    {
        return ResponsesService::success($this->productRepository->update($data));
    }

    public function getProductsByWarehouseId(array $data): array
    {
        return ResponsesService::success($this->productRepository->getProductsByWarehouseId($data['warehouseId']));
    }

    public function getAllRecordsOfProductById(array $data){
        $productPersianFields = $this->productPersianFieldsRepository->getAll();
        $product = $this->productRepository->getAllRecordsOfProductById($data['id'])->toArray();

        foreach($product as $index => $productFields){
            foreach($productPersianFields as $productPersianField){
                if(strtolower($productPersianField->english_name) == strtolower($index)){
                    $product[$index] = ['value' => $productFields,'persian_name' => $productPersianField->persian_name];
                }
                else if(!isset($product[$index]['persian_name'])){
                    $product[$index] = ['value' => $productFields,'persian_name' => null];
                }
            }
        }
        
        return ResponsesService::success($product);
    }
}
