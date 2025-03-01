<?php

namespace App\Services;

use App\Repositories\BuysDetailRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class BuysDetailService
 * @package App\Services
 */
class BuysDetailService
{
    protected $buysDetailRepository;
    public function __construct(BuysDetailRepository $buysDetailRepository)
    {
        $this->buysDetailRepository = $buysDetailRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->buysDetailRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->buysDetailRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->buysDetailRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->buysDetailRepository->update($data));
    }
}
