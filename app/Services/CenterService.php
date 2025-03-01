<?php

namespace App\Services;

use App\Repositories\CenterRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class CenterService
 * @package App\Services
 */
class CenterService
{
    protected $centerRepository;

    public function __construct()
    {
        $this->centerRepository = new CenterRepository();
    }

    public function getAll()
    {
        return ResponsesService::success($this->centerRepository->getAll());
    }

    public function getAllActive()
    {
        return ResponsesService::success($this->centerRepository->getAllActive());
    }
}
