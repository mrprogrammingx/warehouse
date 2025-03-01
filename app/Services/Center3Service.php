<?php

namespace App\Services;

use App\Repositories\Center3Repository;
use App\Services\Globals\ResponsesService;

/**
 * Class Center3Service
 * @package App\Services
 */
class Center3Service
{
    protected $center3Repository;

    public function __construct()
    {
        $this->center3Repository = new Center3Repository();
    }

    public function getAllActive()
    {
        return ResponsesService::success($this->center3Repository->getAllActive());
    }
}
