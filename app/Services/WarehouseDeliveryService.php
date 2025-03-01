<?php

namespace App\Services;

use App\Repositories\WarehouseDeliveryRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class WarehouseDeliveryService
 * @package App\Services
 */
class WarehouseDeliveryService
{
    protected $warehouseDeliveryRepository;
    public function __construct(WarehouseDeliveryRepository $warehouseDeliveryRepository)
    {
        $this->warehouseDeliveryRepository = $warehouseDeliveryRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->warehouseDeliveryRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->warehouseDeliveryRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->warehouseDeliveryRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->warehouseDeliveryRepository->update($data));
    }
}
