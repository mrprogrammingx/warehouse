<?php

namespace App\Services;

use App\Events\StatusEvent;
use App\Interfaces\GlobalVariablesInterface;
use App\Repositories\RequestDetailRepository;
use App\Services\Globals\ResponsesService;

/**
 * Class RequestDetailService
 * @package App\Services
 */
class RequestDetailService
{
    protected $requestDetailRepository, $requestDetailsEditLogService;
    public function __construct(RequestDetailRepository $requestDetailRepository)
    {
        $this->requestDetailRepository = $requestDetailRepository;
        $this->requestDetailsEditLogService = new RequestDetailsEditLogService();
    }

    public function getAll()
    {
        return ResponsesService::success($this->requestDetailRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->requestDetailRepository->store($data));
    }

    public function delete(int $id)
    {
        return ResponsesService::success($this->requestDetailRepository->delete($id));
    }

    public function update(array $data)
    {
        foreach ($data['requestDetails'] as $requestDetail) {
            $oldRequestDetail = $this->getById($requestDetail['id'])->makeHidden('created_at', 'updated_at')->toArray();
            $result[] = $this->storeAndUpdateRequestDetailsEditLogAndRequestDetail(
                $this->tableDataWithInputDataIsEqual($oldRequestDetail, $requestDetail),
                $requestDetail,
                $oldRequestDetail
            );
        }
        return (array_search(true, $result) !== false) ? ResponsesService::success($result) : ResponsesService::error($result);
    }

    public function storeAndUpdateRequestDetailsEditLogAndRequestDetail(bool $tableDataWithInputDataIsEqual, array $requestDetail, array $oldRequestDetail)
    {
        if ($tableDataWithInputDataIsEqual) {
            $result = !$tableDataWithInputDataIsEqual;
        } else {
            $requestDetail['requests_details_id'] = $oldRequestDetail['requests_details_id'] = $requestDetail['id'];
            $requestDetail['user_id'] = $oldRequestDetail['user_id'] = UserService::getUserId() ?? null;
            $requestDetail['flag'] = GlobalVariablesInterface::NEW_DATA_FLAG;
            $oldRequestDetail['flag'] = GlobalVariablesInterface::OLD_DATA_FLAG;
            $requestDetail['edited'] = true;

            $this->requestDetailRepository->update($requestDetail);
            $this->storeOldAndNewDataInRequestDetailsEditLog($requestDetail, $oldRequestDetail);
            $result = !$tableDataWithInputDataIsEqual;
        }
        return $result;
    }

    public function storeOldAndNewDataInRequestDetailsEditLog($newRequestDetail, $oldRequestDetail)
    {
        $this->requestDetailsEditLogService->store($oldRequestDetail);
        $this->requestDetailsEditLogService->store($newRequestDetail);
    }

    public function tableDataWithInputDataIsEqual(array $oldRequestDetail, array $requestDetail)
    {
        foreach (array_keys(array_diff_key($oldRequestDetail, $requestDetail)) as $key) {
            unset($oldRequestDetail[$key]);
        }
        return ($requestDetail == $oldRequestDetail) ? true : false;
    }

    public function updateDeliveryId(array $data)
    {
        $result = [];
        foreach ($data as $validate) {
            array_push($result, $this->requestDetailRepository->updateDeliveryId($validate));
            $requestDetailData = $this->requestDetailRepository->getByRequestId($validate['request_id']);
            StatusEvent::dispatch($validate['request_id'], null, GlobalVariablesInterface::DELIVERING_STEP);
            foreach ($requestDetailData as $requestDetailDatum) {
                StatusEvent::dispatch(null, $requestDetailDatum['id'], GlobalVariablesInterface::DELIVERING_STEP);
            }
        }
        return ResponsesService::success($result);
    }

    public function setDelivered(array $validated)
    {
        $delivered = $this->requestDetailRepository->setDelivered($validated['requestDetailId'], GlobalVariablesInterface::DELIVERED);
        StatusEvent::dispatch(null, $validated['requestDetailId'], GlobalVariablesInterface::ARCHIVE_STEP);
        return ResponsesService::success($delivered);
    }

    public function setStatusForRequestDetails(array $requestDetailIds, int $statusId)
    {
        foreach ($requestDetailIds as $requestDetailId) {
            StatusEvent::dispatch(null, $requestDetailId, $statusId);
        }
    }

    public function checkDeliveryIdExist(int $deliveryId)
    {
        return $this->requestDetailRepository->checkDeliveryIdExist($deliveryId);
    }

    public function updateWarehouseDeliveryId(array $data)
    {
        return $this->requestDetailRepository->updateWarehouseDeliveryId($data['id'], $data['warehouseDeliveryId']);
    }

    public function updateHasRemittanceByRequestId(array $data)
    {
        return $this->requestDetailRepository->updateHasRemittanceByRequestId($data);
    }

    public function hasRemittanceIsZeroForRequestId(array $data)
    {
        return $this->requestDetailRepository->hasRemittanceIsZeroForRequestId($data);
    }

    public function setWarehouseDeliveryId(array $data)
    {
        return $this->requestDetailRepository->setWarehouseDeliveryId($data);
    }

    public function getById(int $id)
    {
        return $this->requestDetailRepository->getById($id);
    }

    public function updateForDeliveredToWarehouse(array $ids)
    {
        foreach($ids as $id){
            $result[] = $this->requestDetailRepository->updateForDeliveredToWarehouse($id);
        }
        return $result;
    }

}
