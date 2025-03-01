<?php

namespace Tests\Unit\Services;

use App\Repositories\MeasureUnitRepository;
use App\Services\MeasureUnitService;
use Database\Factories\MeasureUnitFactory;
use Tests\TestCase;

class MeasureUnitTest extends TestCase
{
    public MeasureUnitService $measureUnitService;
    public MeasureUnitFactory $measureUnitFactory;
    public function setUp():void
    {
        parent::setUp();
        $this->measureUnitFactory = new MeasureUnitFactory();
        $this->measureUnitService = new MeasureUnitService(
            new MeasureUnitRepository()
        );
    }

    public function test_getAll():void
    {
        $response = $this->measureUnitService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store():?object
    {
        $response = $this->measureUnitService->store($this->measureUnitFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete():void
    {
        $measureUnit = $this->test_store();
        $response = $this->measureUnitService->delete($measureUnit->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update():void
    {
        $measureUnit = $this->test_store();
        $response = $this->measureUnitService->update($measureUnit->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
