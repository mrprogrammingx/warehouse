<?php

namespace App\Repositories;

use App\Models\RequestDetail;
use App\Repositories\Globals\fieldRepository;
use App\Services\Globals\ArrayService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class RequestDetailRepository.
 */
class RequestDetailRepository
{
    protected $arrayService;
    public function __construct()
    {
        $this->arrayService = new ArrayService();
    }
    public function getAll()
    {
        return RequestDetail::with('request', 'product', 'status', 'file', 'delivery')->get();
    }

    public function store($data)
    {
        $fields = fieldRepository::tableFields($data, $table = 'requests_details');
        return RequestDetail::create($fields);
    }

    public function delete($id)
    {
        return RequestDetail::destroy($id);
    }

    public function update($data)
    {
        return RequestDetail::where([
            'id' => $data['id']
        ])->update(
            $this->arrayService->removeNullFromArray(fieldRepository::tableFields($data, $table = 'requests_details'))
        );
    }

    public function updateDeliveryId(array $data)
    {
        return RequestDetail::where([
            'request_id' => $data['request_id']
        ])->update([
            'delivery_id' => $data['delivery_id']
        ]);
    }

    public function getByRequestId($requestId)
    {
        return RequestDetail::where([
            'request_id' => $requestId
        ])->get();
    }

    public function setStatusForRequestDetails($ids, $statusId)
    {
        return RequestDetail::whereIn(
            'id',
            $ids
        )->update([
            'status_id' => $statusId
        ]);
    }

    public function updateStatus($id, $statusId)
    {
        return RequestDetail::where([
            'id' => $id
        ])->update([
            'status_id' => $statusId
        ]);
    }

    public function setDelivered($id, $delivered)
    {
        return RequestDetail::where([
            'id' => $id
        ])->update([
            'delivered' => $delivered
        ]);
    }

    public function getRequestIdByRequestDetailsId(int $id)
    {
        return RequestDetail::find($id);
    }

    public function checkDeliveryIdExist(int $deliveryId)
    {
        return RequestDetail::where([
            'delivery_id' => $deliveryId
        ])->exists();
    }

    public function updateWarehouseDeliveryId(int $id, int $warehouseDeliveryId)
    {
        return RequestDetail::where([
            'id' => $id
        ])->update([
            'warehouse_delivery_id' => $warehouseDeliveryId
        ]);
    }

    public function updateHasRemittanceByRequestId(array $data)
    {
        return RequestDetail::where([
            'request_id' => $data['requestId']
        ])->update([
            'has_remittance' => $data['hasRemittance']
        ]);
    }

    public function hasRemittanceIsZeroForRequestId(array $data)
    {
        return RequestDetail::where([
            'request_id' => $data['requestId'],
            'has_remittance' => false
        ])->exists();
    }

    public function setWarehouseDeliveryId(array $data)
    {
        return RequestDetail::where([
            'request_id' => $data['requestId'],
        ])->update([
            'warehouse_delivery_id' => $data['warehouseDeliveryId'],
        ]);
    }

    public function getById($id)
    {
        return RequestDetail::find($id);
    }

    public function setReturnDeliveryId($data)
    {
        return RequestDetail::where([
            'id' => $data['requestDetailId']
        ])
            ->update([
                'return_delivery_id' => $data['returnDeliveryId']
            ]);
    }

    public function updateForReturnToWarehouseStatus($data)
    {
        return RequestDetail::where([
            'id' => $data['requestDetailId']
        ])
            ->update([
                'return_user_id' => $data['userId'],
            ]);
    }

    public function updateForDeliveredToWarehouse($id)
    {
        return RequestDetail::where([
            'id' => $id
        ])
            ->update([
                'returned' => true,
            ]);
    }
}
