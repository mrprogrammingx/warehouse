<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CenterService;

class CenterController extends Controller
{
    protected $centerService;

    public function __construct()
    {
        $this->centerService = new CenterService();
    }

    public function getAll()
    {
        $result = $this->centerService->getAll();

        return response()->json($result, $result['status']);
    }

    public function getAllActive()
    {
        $result = $this->centerService->getAllActive();

        return response()->json($result, $result['status']);
    }
}
