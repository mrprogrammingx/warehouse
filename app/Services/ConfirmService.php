<?php

namespace App\Services;

use App\Repositories\ConfirmRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class ConfirmService
 * @package App\Services
 */
class ConfirmService
{
    protected $confirmRepository;
    public function __construct(ConfirmRepository $confirmRepository)
    {
        $this->confirmRepository = $confirmRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->confirmRepository->getAll());
    }

    public function store(array $data)
    {
        return ($this->confirmRepository->checkIsNotRepetitious($data)) ? ResponsesService::error(null, 'Confirmation has already been registered!') : ResponsesService::success($this->confirmRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->confirmRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->confirmRepository->update($data));
    }
}
