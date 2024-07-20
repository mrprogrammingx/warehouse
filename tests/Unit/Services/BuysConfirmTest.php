<?php

namespace Tests\Unit\Services;

use App\Repositories\BuysConfirmRepository;
use App\Services\BuysConfirmService;
use Database\Factories\BuysConfirmFactory;
use Tests\TestCase;

class BuysConfirmTest extends TestCase
{
    public BuysConfirmService $buysConfirmService;
    public BuysConfirmFactory $buysConfirmFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->buysConfirmFactory = new BuysConfirmFactory();
        $this->buysConfirmService = new BuysConfirmService(
            new BuysConfirmRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->buysConfirmService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->buysConfirmService->store($this->buysConfirmFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $buysConfirm = $this->test_store();
        $response = $this->buysConfirmService->delete($buysConfirm->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $buysConfirm = $this->test_store();
        $response = $this->buysConfirmService->update($buysConfirm->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
