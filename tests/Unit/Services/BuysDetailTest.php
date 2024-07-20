<?php

namespace Tests\Unit\Services;

use App\Repositories\BuysDetailRepository;
use App\Services\BuysDetailService;
use Database\Factories\BuysDetailFactory;
use Tests\TestCase;

class BuysDetailTest extends TestCase
{
    public BuysDetailService $buysDetailService;
    public BuysDetailFactory $buysDetailFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->buysDetailFactory = new BuysDetailFactory();
        $this->buysDetailService = new BuysDetailService(
            new BuysDetailRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->buysDetailService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->buysDetailService->store($this->buysDetailFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $buysDetail = $this->test_store();
        $response = $this->buysDetailService->delete($buysDetail->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $buysDetail = $this->test_store();
        $response = $this->buysDetailService->update($buysDetail->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
