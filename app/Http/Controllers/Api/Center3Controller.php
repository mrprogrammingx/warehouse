<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Center3Service;

class Center3Controller extends Controller
{
    protected $center3Service;

    public function __construct()
    {
        $this->center3Service = new Center3Service();
    }

    public function getAllActive()
    {
        $result = $this->center3Service->getAllActive();

        return response()->json($result, $result['status']);
    }
}
