<?php

namespace App\Services;

use App\Interfaces\GlobalVariablesInterface;
use App\Repositories\DeliveryRepository;
use App\Services\Globals\ResponsesService;

class DeliveryService
{
    protected $deliveryRepository, $requestDetailService;

    public function __construct(DeliveryRepository $deliveryRepository, RequestDetailService $requestDetailService)
    {
        $this->deliveryRepository = $deliveryRepository;
        $this->requestDetailService = $requestDetailService;
    }

    public function getAll()
    {
        return  ResponsesService::success($this->deliveryRepository->getAll());
    }

    public function store(array $data)
    {
        $data['active'] = $data['active'] ?? GlobalVariablesInterface::DELIVERY_ACTIVE_DEFAULT;
        $data['online'] = $data['online'] ?? GlobalVariablesInterface::DELIVERY_ONLINE_DEFAULT;
        return ($this->deliveryRepository->deliveryExists($data)) ? ResponsesService::error($data, 'This courier is already registered in the system!') : ResponsesService::success($this->deliveryRepository->store($data));
    }

    public function delete(int $id)
    {
        return ($this->requestDetailService->checkDeliveryIdExist($id)) ? ResponsesService::error($id,'It is not possible to delete previously created courier!') : ResponsesService::success($this->deliveryRepository->delete($id));
    }

    public function update(array $data)
    {
        return  ResponsesService::success($this->deliveryRepository->update($data));
    }

    public function updateOnlineStatus(array $data)
    {
        $data['id'] = $data['id'] ?? UserService::getUserId();
        return  ResponsesService::success($this->deliveryRepository->updateOnlineStatus($data));
    }

    public function checkVehicleExist(int $vehicleId):bool
    {
        return $this->deliveryRepository->checkVehicleExist($vehicleId);
    }
}
