<?php

namespace Tests\Unit\Services;

use App\Repositories\CategoriesConfirmRepository;
use App\Services\CategoriesConfirmService;
use Database\Factories\CategoriesConfirmFactory;
use Tests\TestCase;

class CategoriesConfirmTest extends TestCase
{
    public CategoriesConfirmService $categoriesConfirmService;
    public CategoriesConfirmFactory $categoriesConfirmFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->categoriesConfirmFactory = new CategoriesConfirmFactory();
        $this->categoriesConfirmService = new CategoriesConfirmService(
            new CategoriesConfirmRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->categoriesConfirmService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->categoriesConfirmService->store($this->categoriesConfirmFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $categoriesConfirm = $this->test_store();
        $response = $this->categoriesConfirmService->delete($categoriesConfirm->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $categoriesConfirm = $this->test_store();
        $response = $this->categoriesConfirmService->update($categoriesConfirm->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
