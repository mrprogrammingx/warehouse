<?php

namespace App\Listeners;

use App\Events\StatusEvent;
use App\Repositories\RequestDetailRepository;
use App\Repositories\RequestRepository;
use App\Services\ChangedStatusLogService;

class StatusRequestListener
{
    protected $requestDetailRepository, $requestRepository, $changedStatusLogService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(RequestDetailRepository $requestDetailRepository, RequestRepository $requestRepository)
    {
        $this->requestDetailRepository = $requestDetailRepository;
        $this->requestRepository = $requestRepository;
        $this->changedStatusLogService = new ChangedStatusLogService();
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\StatusEvent  $event
     * @return void
     */
    public function handle(StatusEvent $event)
    {
        $result['updateRequestDetail'] = ($event->requestDetailId) ? $this->requestDetailRepository->updateStatus($event->requestDetailId, $event->status) : null;
        $result['updateRequest'] = ($event->requestId) ? $this->proccessOfUpdateOfRequestStatus($event) : null;
        return $result;
    }

    public function proccessOfUpdateOfRequestStatus($event)
    {
        $result['updateStatus'] = $this->requestRepository->updateStatus($event->requestId, $event->status);
        $result['changedStatusLogService'] = $this->changedStatusLogService->store($event->requestId, $event->status);
        return $result;
    }
}
