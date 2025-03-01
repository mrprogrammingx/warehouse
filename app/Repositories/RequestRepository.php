<?php

namespace App\Repositories;

use App\Interfaces\GlobalVariablesInterface;
use App\Models\Request;
use App\Repositories\Globals\fieldRepository;
use Illuminate\Support\Facades\Schema;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class RequestRepository.
 */
class RequestRepository
{
    public function getAll()
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm.confirm',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.user',
        )->orderBy('created_at', 'DESC')->paginate(GlobalVariablesInterface::PAGINATE_NUMBER_DEFAULT)->makeHidden(['validated_code']);
    }

    public function store($data)
    {
        $fields = fieldRepository::tableFields($data, $table = 'requests');
        return Request::create($fields);
    }

    public function delete($id)
    {
        return Request::destroy($id);
    }

    public function update($data)
    {
        $fields = fieldRepository::tableFields($data, $table = 'requests');
        return Request::where([
            'id' => $data['id']
        ])->update($fields);
    }

    public function allRequestsOfUserId($userId)
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->where([
            'user_id' => $userId
        ])->orderBy('created_at', 'DESC')->paginate(GlobalVariablesInterface::PAGINATE_NUMBER_DEFAULT);
    }

    public function archivedRequestsOfUserId($userId)
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->where([
            'user_id' => $userId,
            'status_id' => GlobalVariablesInterface::ARCHIVE_STEP,
        ])->orderBy('created_at', 'DESC')->paginate(GlobalVariablesInterface::PAGINATE_NUMBER_DEFAULT);
    }

    public function notArchivedRequestsOfUserId($userId)
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->where([
            'user_id' => $userId,
        ])->where('status_id', '<>', GlobalVariablesInterface::ARCHIVE_STEP)->orderBy('created_at', 'DESC')->get();
    }

    public function allRequestConfirmsByUserId(int $userId, array $validConfirmsId = [])
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->with([
            'request_detail.request_detail_confirm' => function ($query) use ($userId, $validConfirmsId) {
                $query->where('user_id', '=', $userId)->orWhereNull([
                    'user_id'
                ])->whereIn('confirm_id', $validConfirmsId);
            }
        ])->whereHas(
            'request_detail.request_detail_confirm',
            function ($query) use ($userId, $validConfirmsId) {
                $query->where('user_id', '=', $userId)->orWhereNull([
                    'user_id'
                ])->whereIn('confirm_id', $validConfirmsId);
            }
        )->whereIn(
            'status_id',
            [GlobalVariablesInterface::FIRST_STEP, GlobalVariablesInterface::CONFIRMING_STEP]
        )
            ->orderBy('created_at', 'DESC')->get()->makeHidden(['validated_code']);
    }

    public function allRequestsByDeliveryId($deliveryId)
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->with([
            'request_detail' => function ($query) use ($deliveryId) {
                $query->where('delivery_id', '=', $deliveryId);
            }
        ])->whereHas(
            'request_detail',
            function ($query) use ($deliveryId) {
                $query->where('delivery_id', '=', $deliveryId);
            }
        )->where([
            'status_id' => GlobalVariablesInterface::DELIVERING_STEP
        ])->orderBy('created_at', 'DESC')->get()->makeHidden(['validated_code']);
    }

    public function allConfirmsOfUserId($userId)
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->with([
            'request_detail.request_detail_confirm' => function ($query) use ($userId) {
                $query->where('user_id', '=', $userId);
            }
        ])->orderBy('created_at', 'DESC')->get()->makeHidden(['validated_code']);
    }

    public function updateStatus($id, $statusId)
    {
        return Request::where([
            'id' => $id
        ])->update([
            'status_id' => $statusId
        ]);
    }

    public function getAllArchiveStatus()
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.confirm',
            'request_detail.request_detail_confirm.user',
        )->where([
            'status_id' => GlobalVariablesInterface::ARCHIVE_STEP
        ])->orderBy('created_at', 'DESC')->paginate(GlobalVariablesInterface::PAGINATE_NUMBER_DEFAULT)->makeHidden(['validated_code']);
    }

    public function getAllCancelStatus()
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.confirm',
            'request_detail.request_detail_confirm.user',
        )->where([
            'status_id' => GlobalVariablesInterface::CANCEL_STEP
        ])->orderBy('created_at', 'DESC')->paginate(GlobalVariablesInterface::PAGINATE_NUMBER_DEFAULT)->makeHidden(['validated_code']);
    }

    public function getAllIsNotArchiveStatus()
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.confirm',
            'request_detail.request_detail_confirm.user',
        )->where(
            'status_id',
            '<>',
            GlobalVariablesInterface::ARCHIVE_STEP
        )->orderBy('created_at', 'DESC')->get()->makeHidden(['validated_code']);
    }

    public function getAllIsNotArchiveAndCancelStatus()
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.confirm',
            'request_detail.request_detail_confirm.user',
        )->whereNotIn(
            'status_id',
            [GlobalVariablesInterface::ARCHIVE_STEP, GlobalVariablesInterface::CANCEL_STEP]
        )->orderBy('created_at', 'DESC')->get()->makeHidden(['validated_code']);
    }

    public function checkValidatedCode(int $requestId, int $validatedCode): bool
    {
        return Request::where([
            'id' => $requestId,
            'validated_code' => $validatedCode,
        ])->exists();
    }

    public function showDeliveriesStatus()
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->whereIn(
            'status_id',
            [
                GlobalVariablesInterface::DELIVERY_STEP,
                GlobalVariablesInterface::DELIVERING_STEP,
            ]
        )->orderBy('created_at', 'DESC')->get()->makeHidden(['validated_code']);
    }

    public function showDeliveriesStatusWithoutDelivery()
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->whereIn(
            'status_id',
            [
                GlobalVariablesInterface::DELIVERY_STEP,
                GlobalVariablesInterface::DELIVERING_STEP,
            ]
        )->whereHas(
            'request_detail',
            function ($query) {
                $query->whereNull([
                    'delivery_id'
                ]);
            }
        )->orderBy('created_at', 'DESC')->get()->makeHidden(['validated_code']);
    }

    public function showDeliveriesStatusWithDelivery()
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->whereIn(
            'status_id',
            [
                GlobalVariablesInterface::DELIVERY_STEP,
                GlobalVariablesInterface::DELIVERING_STEP,
            ]
        )->whereHas(
            'request_detail',
            function ($query) {
                $query->whereNotNull([
                    'delivery_id'
                ]);
            }
        )->orderBy('created_at', 'DESC')->get()->makeHidden(['validated_code']);
    }

    public function getById(int $id)
    {
        return Request::find($id);
    }

    public function updateHasRemittanceByRequestId(array $data)
    {
        return Request::where([
            'id' => $data['requestId']
        ])->update([
            'has_remittance' => $data['hasRemittance']
        ]);
    }

    public function hasRemittanceIsZeroForRequestId(array $data)
    {
        return Request::where([
            'id' => $data['requestId'],
            'has_remittance' => false
        ])->exists();
    }

    public function getAllDetailsById(int $id)
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm.confirm',
            'request_detail.request_detail_confirm',
            'request_detail.request_detail_confirm.user',
        )->where([
            'id' => $id
        ])->get();
    }

    public function getAllForWarehouseDeliveryIdIsNotArchiveAndCancel($warehouseDeliveryId)
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->with([
            'request_detail' => function ($query) use ($warehouseDeliveryId) {
                $query->where('warehouse_delivery_id', '=', $warehouseDeliveryId);
            }
        ])->whereHas(
            'request_detail',
            function ($query) use ($warehouseDeliveryId) {
                $query->where('warehouse_delivery_id', '=', $warehouseDeliveryId);
            }
        )->whereNotIn(
            'status_id',
            [GlobalVariablesInterface::ARCHIVE_STEP, GlobalVariablesInterface::CANCEL_STEP]
        )->orderBy('created_at', 'DESC')->get()->makeHidden(['validated_code']);
    }

    public function seValidatedCode($data)
    {
        return Request::where([
            'id' => $data['requestId']
        ])->update([
            'validated_code' => $data['validatedCode']
        ]);
    }

    public function getAllReturnToWarehouseStatus()
    {
        return Request::with(
            'unit',
            'user',
            'status',
            'request_detail',
            'request_detail.center',
            'request_detail.status',
            'request_detail.product',
            'request_detail.warehouse',
            'request_detail.delivery.user',
            'request_detail.delivery.vehicle',
            'request_detail.fileRequestDetail.file',
            'request_detail.request_detail_confirm.user',
            'request_detail.request_detail_confirm.confirm',
        )->where([
            'status_id' => GlobalVariablesInterface::RETURN_TO_WAREHOUSE_STEP
        ])
        ->orderBy('created_at', 'DESC')->get();
    }
}
