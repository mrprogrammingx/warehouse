<?php

namespace App\Services;

use App\Repositories\ChangedStatusLogRepository;

/**
 * Class ChangedStatusLogService
 * @package App\Services
 */
class ChangedStatusLogService
{
    protected $changedStatusLogRepository;
    public function __construct()
    {
        $this->changedStatusLogRepository = new ChangedStatusLogRepository();
    }

    public function store(int $requestId,int $statusId)
    {
        $data['request_id'] = $requestId;
        $data['status_id'] = $statusId;
        $data['user_id'] = UserService::getUserId();
        return $this->changedStatusLogRepository->store($data);
    }
}
