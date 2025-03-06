<?php

namespace App\Http\Controllers\Api\MainDashboard;

use App\Http\Controllers\Controller;
use App\Services\Globals\ResponsesService;

class FoodController extends Controller
{
    public function getCountOfDeliveryReservationPerDayOfWeek()
    {
        //TODO
        $result = ResponsesService::success([
            'count' => [
                ['count' => 1, 'date' => now()],
                ['count' => 2, 'date' => now()],
                ['count' => 3, 'date' => now()]
            ]
        ]);

        return response()->json($result, $result['status']);
    }

    public function getCountOfReservationPerDayOfWeek()
    {
        //TODO
        $result = ResponsesService::success([
            'count' => [
                ['count' => 2, 'date' => now()],
                ['count' => 3, 'date' => now()],
                ['count' => 4, 'date' => now()]
            ]
        ]);

        return response()->json($result, $result['status']);
    }
}
