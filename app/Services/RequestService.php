<?php

namespace App\Services;

use App\Events\StatusEvent;
use App\Interfaces\GlobalVariablesInterface;
use App\Repositories\DeliveryRepository;
use App\Repositories\FileRepository;
use App\Repositories\FileRequestDetailRepository;
use App\Repositories\RequestDetailRepository;
use App\Repositories\RequestRepository;
use App\Repositories\UsersConfirmRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class RequestService
 * @package App\Services
 */
class RequestService
{
    protected $requestRepository, $requestDetailRepository, $usersUnitService, $fileRepository, $fileService, $fileRequestDetailRepository, $fileRequestDetailService, $timeService, $requestsDetailsConfirmService, $usersConfirmRepository, $requestDetailService, $deliveryRepository;
    public function __construct(
        RequestRepository $requestRepository,
        RequestDetailRepository $requestDetailRepository,
        UsersUnitService $usersUnitService,
        FileRepository $fileRepository,
        FileService $fileService,
        FileRequestDetailRepository $fileRequestDetailRepository,
        FileRequestDetailService $fileRequestDetailService,
        RequestsDetailsConfirmService $requestsDetailsConfirmService,
        UsersConfirmRepository $usersConfirmRepository,
        RequestDetailService $requestDetailService
    ) {
        $this->requestRepository = $requestRepository;
        $this->requestDetailRepository = $requestDetailRepository;
        $this->usersUnitService = $usersUnitService;
        $this->fileRepository = $fileRepository;
        $this->fileService = $fileService;
        $this->fileRequestDetailRepository = $fileRequestDetailRepository;
        $this->fileRequestDetailService = $fileRequestDetailService;
        $this->requestsDetailsConfirmService = $requestsDetailsConfirmService;
        $this->usersConfirmRepository = $usersConfirmRepository;
        $this->requestDetailService = $requestDetailService;
        $this->deliveryRepository = new DeliveryRepository();
        $this->timeService = new TimeService();
    }

    public function getAll()
    {
        return ResponsesService::success($this->requestRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->requestRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->requestRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->requestRepository->update($data));
    }

    public function storeRequestAndRequestDetails(array $data)
    {
        if (!$this->checkRequestsDetailsNotBeRepetitiousData($data['requestDetails'])) {
            return ResponsesService::error(null, 'Duplicate product!');
        }

        $userData = $this->getParamsForRequestsTable();
        $data['request']['user_id'] = $userData['user_id'];
        $data['request']['unit_id'] = $userData['unit_id'];
        $data['request']['request_number'] = $this->buildRequestNumber();
        $data['request']['validated_code'] = $this->buildGenerateNumber();
        $requestData = $this->requestRepository->store($data['request']);
        StatusEvent::dispatch($requestData->id, null, GlobalVariablesInterface::FIRST_STEP);

        $requestDetailsData = [];
        foreach ($data['requestDetails'] as $requestDetail) {
            $requestDetail['request_id'] = $requestData->id;
            $requestDetail['warehouses_id'] = $data['request']['warehouses_id'];
            $productId = $requestDetail['product_id'];
            $requestDetailsDatum = $this->requestDetailRepository->store($requestDetail);
            StatusEvent::dispatch(null, $requestDetailsDatum->id, GlobalVariablesInterface::FIRST_STEP);
            $DefinesConfirms = $this->requestsDetailsConfirmService->storeDefinesConfirmsForRequestDetail($productId, $requestDetailsDatum->id);
            if (!empty($DefinesConfirms['productConfirms']) || !empty($DefinesConfirms['categoryConfirms'])) {
                StatusEvent::dispatch($requestDetail['request_id'], $requestDetailsDatum->id, GlobalVariablesInterface::CONFIRMING_STEP);
            }
            if (isset($requestDetail['file_id'])) {
                $this->fileRequestDetailService->storeArrayfileIds($requestDetail['file_id'], $requestDetailsDatum->id);
            }
            array_push($requestDetailsData, $requestDetailsDatum);
        }
        return ResponsesService::success(['requestData' => $requestData, 'requestDetailsData' => $requestDetailsData]);
    }

    public function allRequestConfirmsByUserId(array $data)
    {
        $data['user_id']  = $data['user_id'] ?? UserService::getUserId();
        $validConfirmsId = $this->usersConfirmRepository->getByUserId($data['user_id']);
        return ResponsesService::success($this->requestRepository->allRequestConfirmsByUserId($data['user_id'], array_column($validConfirmsId->toArray(), 'confirm_id')));
    }

    public function getParamsForRequestsTable()
    {
        $result['user_id'] = UserService::getUserId();
        $result['unit_id'] = $this->usersUnitService->getUnitIdByUserId($result['user_id']);
        return $result;
    }

    public function allRequestsOfUserId(array $data)
    {
        return ResponsesService::success($this->requestRepository->allRequestsOfUserId($data['user_id'] ?? UserService::getUserId()));
    }

    public function archivedRequestsOfUserId(array $data)
    {
        return ResponsesService::success($this->requestRepository->archivedRequestsOfUserId($data['user_id'] ?? UserService::getUserId()));
    }

    public function notArchivedRequestsOfUserId(array $data)
    {
        return ResponsesService::success($this->requestRepository->notArchivedRequestsOfUserId($data['user_id'] ?? UserService::getUserId()));
    }

    public static function buildRequestNumber()
    {
        return  date('ymdhis', time()) . '/' . rand(GlobalVariablesInterface::START_RANGE_FOR_RANDOM_REQUEST_NUMBER, GlobalVariablesInterface::END_RANGE_FOR_RANDOM_REQUEST_NUMBER);
    }

    public function buildGenerateNumber()
    {
        return rand(GlobalVariablesInterface::START_RANGE_FOR_GENERATE_NUMBER, GlobalVariablesInterface::END_RANGE_FOR_GENERATE_NUMBER);
    }
    public function allRequestsByDeliveryId(array $data)
    {
        return ResponsesService::success(isset($data['delivery_id']) ? [$this->getAllRequestsByDeliveryId($data['delivery_id'])] : $this->getAllRequestsOfCurrentDeliveryId());
    }

    public function getAllRequestsByDeliveryId(int $delivery)
    {
        return $this->requestRepository->allRequestsByDeliveryId($delivery);
    }

    public function getAllRequestsOfCurrentDeliveryId()
    {
        $this->deliveryRepository->getDeliveryByUserId(UserService::getUserId());
        $deliveries = $this->deliveryRepository->getDeliveryByUserId(UserService::getUserId());
        $result = [];
        foreach ($deliveries as $delivery) {
            $result = array_merge($result, $this->requestRepository->allRequestsByDeliveryId($delivery->id)->toArray());
        }
        return $result;
    }

    public function allConfirmsOfUserId(array $data)
    {
        return ResponsesService::success($this->requestRepository->allConfirmsOfUserId($data['userId'] ?? UserService::getUserId()));
    }

    public function getAllArchiveStatus()
    {
        return ResponsesService::success($this->requestRepository->getAllArchiveStatus());
    }

    public function getAllCancelStatus()
    {
        return ResponsesService::success($this->requestRepository->getAllCancelStatus());
    }

    public function getAllIsNotArchiveStatus()
    {
        return ResponsesService::success($this->requestRepository->getAllIsNotArchiveStatus());
    }

    public function getAllIsNotArchiveAndCancelStatus()
    {
        return ResponsesService::success($this->requestRepository->getAllIsNotArchiveAndCancelStatus());
    }

    public function checkValidatedCode(array $data)
    {
        return $this->requestRepository->checkValidatedCode($data['requestId'], $data['validatedCode']);
    }

    public function processOfValidCode(array $data)
    {
        if ($this->checkValidatedCode($data) == true) {
            $requestDetailsData = $this->requestDetailRepository->getByRequestId($data['requestId']);
            foreach ($requestDetailsData as $requestDetailsDatum) {
                $this->requestDetailRepository->setDelivered($requestDetailsDatum->id, GlobalVariablesInterface::DELIVERED);
            }
            $this->setStatusForRequestAndItsRequestDetails($data, GlobalVariablesInterface::ARCHIVE_STEP);
            return ResponsesService::success();
        } else
            return ResponsesService::error(null, 'The delivery code is not valid!');
    }

    public function setStatusForRequestAndItsRequestDetails(array $data, int $statusId): ?array
    {
        $currentStatusId = $this->requestRepository->getById($data['requestId'])->status_id;
        $changeStatusConditions = $this->changeStatusConditions($data['requestId'], $statusId, $currentStatusId);

        if (!$changeStatusConditions['success'])
            return ResponsesService::error(null, $changeStatusConditions['message']);
        $requestDetailsData = $this->requestDetailRepository->getByRequestId($data['requestId']);
        $this->requestDetailService->setStatusForRequestDetails(array_column($requestDetailsData->toArray(), 'id'), $statusId);
        return ResponsesService::success(StatusEvent::dispatch($data['requestId'], null, $statusId));
    }

    public function changeStatusConditions(int $requestId, int $statusId, int $currentStatusId): ?array
    {
        switch ($statusId) {
            case GlobalVariablesInterface::DELIVERY_STEP:
                $result['success'] = $this->requestsDetailsConfirmService->requestIsConfirmed($requestId);
                $result['message'] = ($result['success']) ? '' : 'It is possible to send by courier only for confirmed requests.';
                break;
            case GlobalVariablesInterface::CANCEL_STEP:
                $result['success'] = $this->checkStatusIsValidForChangeToCancel($currentStatusId);
                $result['message'] =  ($result['success']) ? '' : 'It is not possible to cancel the request in this status!';
                break;
            default:
                $result['success'] = true;
                $result['message'] = '';
                break;
        }
        return $result;
    }

    public function checkStatusIsValidForChangeToCancel($currentStatusId)
    {
        return ($currentStatusId == GlobalVariablesInterface::ARCHIVE_STEP || $currentStatusId == GlobalVariablesInterface::DELIVERY_STEP  || $currentStatusId == GlobalVariablesInterface::DELIVERING_STEP) ? false : true;
    }

    public function showDeliveriesStatus()
    {
        $deliveriesStatus = $this->requestRepository->showDeliveriesStatus();
        $confirmesDeliveriesStatus = $this->separateConfirmed($deliveriesStatus);
        return ResponsesService::success($confirmesDeliveriesStatus);
    }

    public function separateConfirmed($requests)
    {
        $requestsConfirmed = [];
        foreach ($requests as $request) {
            if ($request->confirmed == GlobalVariablesInterface::CONFIRMED) {
                array_push($requestsConfirmed, $request);
            }
        }
        return $requestsConfirmed;
    }

    public function showDeliveriesStatusWithoutDelivery()
    {
        $deliveriesStatus = $this->requestRepository->showDeliveriesStatusWithoutDelivery();
        $confirmesDeliveriesStatus = $this->separateConfirmed($deliveriesStatus);
        return ResponsesService::success($confirmesDeliveriesStatus);
    }

    public function showDeliveriesStatusWithDelivery()
    {
        $deliveriesStatus = $this->requestRepository->showDeliveriesStatusWithDelivery();
        $confirmesDeliveriesStatus = $this->separateConfirmed($deliveriesStatus);
        return ResponsesService::success($confirmesDeliveriesStatus);
    }

    public function checkRequestsDetailsNotBeRepetitiousData(array $requestsDetails)
    {
        $productsIdsDupes = $this->arrayHasDupes(array_column($requestsDetails, 'product_id'));
        return ($productsIdsDupes) ? false : true;
    }

    public function arrayHasDupes(array $array)
    {
        return count($array) !== count(array_unique($array));
    }

    public function updateHasRemittanceByRequestId(array $data)
    {
        return $this->requestRepository->updateHasRemittanceByRequestId($data);
    }

    public function hasRemittanceIsZeroForRequestId(array $data)
    {
        return $this->requestRepository->hasRemittanceIsZeroForRequestId($data);
    }

    public function getAllDetailsById(array $data)
    {
        return ResponsesService::success($this->requestRepository->getAllDetailsById($data['requestId']));
    }

    public function getAllForWarehouseDeliveryIdIsNotArchiveAndCancel(array $data)
    {
        return ResponsesService::success($this->requestRepository->getAllForWarehouseDeliveryIdIsNotArchiveAndCancel($data['warehouseDeliveryId']));
    }

    public function processOfSetReturnToWarehouseStatus(array $data)
    {
        $data['validatedCode'] = $this->buildGenerateNumber();
        $this->requestRepository->seValidatedCode($data);
        $this->changeStatusToReturnToWarehouseStatus($data);

        return ResponsesService::success($data);
    }

    public function changeStatusToReturnToWarehouseStatus(array $data)
    {
        StatusEvent::dispatch($data['requestId'], null, GlobalVariablesInterface::RETURN_TO_WAREHOUSE_STEP);
        foreach ($data['requestDetail'] as $requestDetail) {
            $data['requestDetailId'] = $requestDetail['id'];
            $data['userId'] = UserService::getUserId();
            $this->requestDetailRepository->updateForReturnToWarehouseStatus($data);
            StatusEvent::dispatch(null, $data['requestDetailId'], GlobalVariablesInterface::RETURN_TO_WAREHOUSE_STEP);
        }
    }

    public function processOfSetReturnDeliveryId(array $data)
    {
        $data['validatedCode'] = $this->buildGenerateNumber();
        $this->requestRepository->seValidatedCode($data);
        foreach ($data['requestDetail'] as $requestDetail) {
            $data['requestDetailId'] = $requestDetail['id'];
            $this->requestDetailRepository->setReturnDeliveryId($data);
        }
        return ResponsesService::success($data);
    }

    public function processOfValidCodeForReturnToDelivery(array $data)
    {
        return ($this->checkValidatedCode($data)) ? ResponsesService::success($data) : ResponsesService::error($data, 'The confirmation code is incorrect');
    }

    public function processOfValidCodeForReturnToWarehouse(array $data)
    {
        return ($this->checkValidatedCode($data)) ? ResponsesService::success($this->requestDetailService->updateForDeliveredToWarehouse($data['requestDetail'])) : ResponsesService::error($data, 'The confirmation code is incorrect');
    }

    public function storeRequestAndRequestDetailsWithoutConfirms(array $data)
    {
        if (!$this->checkRequestsDetailsNotBeRepetitiousData($data['requestDetails'])) {
            return ResponsesService::error(null, 'Duplicate product!');
        }
        
        $data['request']['request_number'] = $this->buildRequestNumber();
        $data['request']['validated_code'] = $this->buildGenerateNumber();
        $requestData = $this->requestRepository->store($data['request']);
        StatusEvent::dispatch($requestData->id, null, GlobalVariablesInterface::FIRST_STEP);

        $requestDetailsData = [];
        foreach ($data['requestDetails'] as $requestDetail) {
            $requestDetail['request_id'] = $requestData->id;
            $requestDetail['old_request_id'] = $requestDetail['old_request_id'];
            $requestDetail['changed_product'] = true;
            $requestDetail['warehouses_id'] = $data['request']['warehouses_id'];
            $requestDetailsDatum = $this->requestDetailRepository->store($requestDetail);
            StatusEvent::dispatch(null, $requestDetailsDatum->id, GlobalVariablesInterface::FIRST_STEP);
            
            (isset($requestDetail['file_id'])) ? $this->fileRequestDetailService->storeArrayfileIds($requestDetail['file_id'], $requestDetailsDatum->id) : true;
            array_push($requestDetailsData, $requestDetailsDatum);
        }
        return ResponsesService::success(['requestData' => $requestData, 'requestDetailsData' => $requestDetailsData]);
    }

    public function getAllReturnToWarehouseStatus()
    {
        return ResponsesService::success($this->requestRepository->getAllReturnToWarehouseStatus());
    }
}
