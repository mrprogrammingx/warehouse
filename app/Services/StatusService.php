<?php

namespace App\Services;

use App\Repositories\StatusRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class StatusService
 * @package App\Services
 */
class StatusService
{
    protected $statusRepository;
    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->statusRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->statusRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->statusRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->statusRepository->update($data));
    }
}
