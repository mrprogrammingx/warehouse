<?php

namespace Tests\Unit\Services;

use App\Services\ItemConsumptionTypeService;
use Tests\TestCase;

class ItemConsumptionTypeTest extends TestCase
{
    public ItemConsumptionTypeService $itemConsumptionTypeService;
    public function setUp():void
    {
        parent::setUp();
        $this->itemConsumptionTypeService = new ItemConsumptionTypeService();
    }

    public function test_getAllActive()
    {
        $response = $this->itemConsumptionTypeService->getAllActive();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
