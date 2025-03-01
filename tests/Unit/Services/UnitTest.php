<?php

namespace Tests\Unit\Services;

use App\Repositories\UnitRepository;
use App\Services\UnitService;
use Database\Factories\UnitFactory;
use Tests\TestCase;

class UnitTest extends TestCase
{
    public UnitService $unitService;
    public UnitFactory $unitFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->unitFactory = new UnitFactory();
        $this->unitService = new UnitService(
            new UnitRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->unitService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->unitService->store($this->unitFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $unit = $this->test_store();
        $response = $this->unitService->delete($unit->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $unit = $this->test_store();
        $response = $this->unitService->update($unit->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
