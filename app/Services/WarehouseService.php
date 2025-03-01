<?php

namespace App\Services;

use App\Repositories\WarehouseRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class WarehouseService
 * @package App\Services
 */
class WarehouseService
{
    protected $warehouseRepository;
    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->warehouseRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->warehouseRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->warehouseRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->warehouseRepository->update($data));
    }

    public function getAllActiveWarehouses()
    {
        return ResponsesService::success($this->warehouseRepository->getAllActiveWarehouses());
    }
}
