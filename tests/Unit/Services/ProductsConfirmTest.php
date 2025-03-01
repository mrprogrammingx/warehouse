<?php

namespace Tests\Unit\Services;

use App\Repositories\ProductsConfirmRepository;
use App\Services\ProductsConfirmService;
use Database\Factories\ProductsConfirmFactory;
use Tests\TestCase;

class ProductsConfirmTest extends TestCase
{
    public ProductsConfirmService $productsConfirmService;
    public ProductsConfirmFactory $productsConfirmFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->productsConfirmFactory = new ProductsConfirmFactory();
        $this->productsConfirmService = new ProductsConfirmService(
            new ProductsConfirmRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->productsConfirmService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->productsConfirmService->store($this->productsConfirmFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_getByProductId()
    {
        $data = [
            'product_id' => 1
        ];
        $response = $this->productsConfirmService->getByProductId($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
