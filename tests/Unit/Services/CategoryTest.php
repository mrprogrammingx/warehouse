<?php

namespace Tests\Unit\Services;

use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Database\Factories\CategoryFactory;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public CategoryService $categoryService;
    public CategoryFactory $categoryFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->categoryFactory = new CategoryFactory();
        $this->categoryService = new CategoryService(
            new CategoryRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->categoryService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->categoryService->store($this->categoryFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $category = $this->test_store();
        $response = $this->categoryService->delete($category->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $category = $this->test_store();
        $response = $this->categoryService->update($category->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
