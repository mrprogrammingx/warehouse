<?php

namespace App\Services;

use App\Repositories\RequestsConfirmRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class RequestsConfirmService
 * @package App\Services
 */
class RequestsConfirmService
{
    protected $requestsConfirmRepository;
    public function __construct(RequestsConfirmRepository $requestsConfirmRepository)
    {
        $this->requestsConfirmRepository = $requestsConfirmRepository;
    }

    public function getAll()
    {
        return ResponsesService::success($this->requestsConfirmRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->requestsConfirmRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->requestsConfirmRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->requestsConfirmRepository->update($data));
    }

    public function getRequestsByDeliveryId(array $data)
    {
        return ResponsesService::success($this->requestsConfirmRepository->getRequestsByDeliveryId($data['user_id']));
    }
}
