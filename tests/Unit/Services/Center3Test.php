<?php

namespace Tests\Unit\Services;

use App\Services\Center3Service;
use Tests\TestCase;

class Center3Test extends TestCase
{
    public $center3Service;
    public function setUp():void
    {
        parent::setUp();
        $this->center3Service = new Center3Service();
    }

    public function test_getAllActive()
    {
        $response = $this->center3Service->getAllActive();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

}
