<?php

namespace Tests\Unit\Services\Globals;

use App\Services\Globals\ArrayService;
use PHPUnit\Framework\TestCase;

class ArrayTest extends TestCase
{

    public ArrayService $arrayService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->arrayService = new ArrayService();
    }

    public function test_removeNullFromArray()
    {
        $array = ['','','',null,'test'];
        $response = $this->arrayService->removeNullFromArray($array);
        $this->assertEquals($response , ['4' => 'test']);
    }
}
