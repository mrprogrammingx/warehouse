<?php

namespace App\Services;

use App\Repositories\UnitRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class UnitService
 * @package App\Services
 */
class UnitService
{
    protected $unitRepository;
    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->unitRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->unitRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->unitRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->unitRepository->update($data));
    }
}
