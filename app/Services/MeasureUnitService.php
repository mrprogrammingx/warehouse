<?php

namespace App\Services;

use App\Repositories\MeasureUnitRepository;
use App\Services\Globals\ResponsesService;

class MeasureUnitService
{
    protected $measureUnitRepository;
    public function __construct(MeasureUnitRepository $measureUnitRepository)
    {
        $this->measureUnitRepository = $measureUnitRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->measureUnitRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->measureUnitRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->measureUnitRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->measureUnitRepository->update($data));
    }
}
