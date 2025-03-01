<?php

namespace App\Services;

use App\Repositories\RequestDetailsEditLogRepository;

/**
 * Class RequestDetailsEditLogService
 * @package App\Services
 */
class RequestDetailsEditLogService
{
    protected $requestDetailsEditLogRepository;
    public function __construct()
    {
        $this->requestDetailsEditLogRepository = new RequestDetailsEditLogRepository();
    }

    public function store(array $data)
    {
        return $this->requestDetailsEditLogRepository->store($data);
    }
}
