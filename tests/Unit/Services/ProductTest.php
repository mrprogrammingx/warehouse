<?php

namespace Tests\Unit\Services;

use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Database\Factories\ProductFactory;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public ProductService $productService;
    public ProductFactory $productFactory;
    public function setUp(): void
    {
        parent::setUp();
        $this->productFactory = new ProductFactory();
        $this->productService = new ProductService(
            new ProductRepository()
        );
    }

    public function test_getAll(): void
    {
        $response = $this->productService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store(): ?object
    {
        $response = $this->productService->store($this->productFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete(): void
    {
        $product = $this->test_store();
        $response = $this->productService->delete($product->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update(): void
    {
        $product = $this->test_store();
        $response = $this->productService->update($product->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getProductsByWarehouseId()
    {
        $data = [
            'warehouseId' => rand(1, 10)
        ];
        $response = $this->productService->getProductsByWarehouseId($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getAllRecordsOfProductById()
    {
        $product = $this->test_store();
        $data = [
            'id' => $product->id
        ];
        $response = $this->productService->getAllRecordsOfProductById($data);
        $data = $response['data'];
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);

        $this->assertTrue(
            array_key_exists('name', $data) &&
            array_key_exists('attributes', $data) &&
            array_key_exists('worn', $data) &&
            array_key_exists('descriptions', $data) &&
            array_key_exists('file_id', $data) &&
            array_key_exists('category_id', $data) &&
            array_key_exists('rayvarz_id', $data) &&
            array_key_exists('technical_index_id', $data)
        );
    }
}