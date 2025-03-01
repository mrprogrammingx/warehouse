<?php

namespace Tests\Unit\Services;

use App\Services\CenterService;
use Tests\TestCase;

class CenterTest extends TestCase
{
    public CenterService $centerService;
    public function setUp():void
    {
        parent::setUp();
        $this->centerService = new CenterService();
    }

    public function test_getAll():void
    {
        $response = $this->centerService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getAllActive():void
    {
        $response = $this->centerService->getAllActive();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }
}
