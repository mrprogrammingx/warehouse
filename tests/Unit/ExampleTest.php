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
        //var_dump([$currentYear,$currentMonth,$currentDay,$currentDate]);die;
        //'LKHYgbn776tgubkjhk'
        //var_dump(RequestService::buildRequestNumber());die;
        $this->assertTrue(true);
    }

    // public function testDeleteFile(){
    //     $request = new Request();
    //     $request->id = 1;
    //     var_dump((new FileController(new FileService(new FileRepository(),new FilesCategoryRepository())))->delete($request));die;
    //     // requestdetails/delete/{id}
    // }

}
