<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ItemConsumptionTypeService;


class ItemConsumptionTypeController extends Controller
{
    protected $itemConsumptionTypeService;

    public function __construct()
    {
        $this->itemConsumptionTypeService = new ItemConsumptionTypeService();
    }

    public function getAllActive()
    {
        $result = $this->itemConsumptionTypeService->getAllActive();

        return response()->json($result, $result['status']);
    }
}
