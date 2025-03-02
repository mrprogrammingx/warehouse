<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\FileController;
use App\Repositories\FileRepository;
use App\Repositories\FilesCategoryRepository;
use App\Repositories\RequestRepository;
use App\Services\FileService;
use App\Services\RequestService;
use App\Services\TimeService;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertTrue;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testTime(){
        $timeService = new TimeService();
        $currentYear = ($timeService)->currentYear();
        $currentMonth = ($timeService)->currentMonth();
        $currentDay = ($timeService)->currentDay();
        $currentDate = ($timeService)->currentManualDate();
        $this->assertTrue(true);
    }

}
