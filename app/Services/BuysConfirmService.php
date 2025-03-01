<?php

namespace App\Services;

use App\Repositories\BuysConfirmRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class BuysConfirmService
 * @package App\Services
 */
class BuysConfirmService
{
    protected $buysConfirmRepository;
    public function __construct(BuysConfirmRepository $buysConfirmRepository)
    {
        $this->buysConfirmRepository = $buysConfirmRepository;
    }

    public function getAll(): array
    {
        return ResponsesService::success($this->buysConfirmRepository->getAll());
    }

    public function store(array $data): array
    {
        return ResponsesService::success($this->buysConfirmRepository->store($data));
    }

    public function delete(int $id): array
    {
        return ResponsesService::success($this->buysConfirmRepository->delete($id));
    }

    public function update(array $data): array
    {
        return ResponsesService::success($this->buysConfirmRepository->update($data));
    }
}
