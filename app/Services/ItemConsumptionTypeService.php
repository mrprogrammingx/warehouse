<?php

namespace App\Services;

use App\Repositories\ItemConsumptionTypeRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class ItemConsumptionTypeService
 * @package App\Services
 */
class ItemConsumptionTypeService
{
    protected $itemConsumptionTypeRepository;

    public function __construct()
    {
        $this->itemConsumptionTypeRepository = new ItemConsumptionTypeRepository();
    }

    public function getAllActive()
    {
        return ResponsesService::success($this->itemConsumptionTypeRepository->getAllActive());
    }
}
