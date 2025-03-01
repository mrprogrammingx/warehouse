<?php

namespace Tests\Unit\Services;

use App\Services\TimeService;
use Tests\TestCase;

class TimeTest extends TestCase
{
    public TimeService $timeService;
    public function setUp():void
    {
        parent::setUp();
        $this->timeService = new TimeService();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_currentYear()
    {
        $lengthOfYear = 4;
        $currentYearManually = 1402;
        $currentYear = $this->timeService->currentYear();
        $this->assertTrue(strlen($currentYear) == $lengthOfYear && $currentYear >= $currentYearManually );
    }

    public function test_currentMonth()
    {
        $currentMonth = $this->timeService->currentMonth();
        $this->assertIsInt($currentMonth);
    }

    public function test_currentDay()
    {
        $currentDay = $this->timeService->currentDay();
        $this->assertIsInt($currentDay);
    }

    public function test_currentDate()
    {
        $currentDate = $this->timeService->currentDate();
        $this->assertArrayHasKey("date", (array) $currentDate);
        $this->assertArrayHasKey("timezone_type", (array) $currentDate);
        $this->assertArrayHasKey("timezone", (array) $currentDate);
    }

    public function test_currentManualDate()
    {
        $response = $this->timeService->currentManualDate(); 
        $this->assertIsString($response);
    }
}
