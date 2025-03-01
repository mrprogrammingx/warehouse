<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'requestDetail-list']);
        Permission::create(['name' => 'requestDetail-store']);
        Permission::create(['name' => 'requestDetail-update']);
        Permission::create(['name' => 'requestDetail-updateDeliveryId']);
        Permission::create(['name' => 'requestDetail-setDelivered']);
        Permission::create(['name' => 'requestDetail-delete']);
        Permission::create(['name' => 'requestDetail-updateWarehouseDeliveryId']);
        Permission::create(['name' => 'requestDetail-setWarehouseDeliveryId']);

        Permission::create(['name' => 'request-list']);
        Permission::create(['name' => 'request-update']);
        Permission::create(['name' => 'request-delete']);
        Permission::create(['name' => 'request-store']);
        Permission::create(['name' => 'request-storeRequestAndRequestDetails']);
        Permission::create(['name' => 'request-getCurrentDate']);
        Permission::create(['name' => 'request-allRequestsOfUserId']);
        Permission::create(['name' => 'request-allRequestConfirmsByUserId']);
        Permission::create(['name' => 'request-allRequestsByDeliveryId']);
        Permission::create(['name' => 'request-allConfirmsOfUserId']);
        Permission::create(['name' => 'request-getAllArchiveStatus']);
        Permission::create(['name' => 'request-getAllIsNotArchiveStatus']);
        Permission::create(['name' => 'request-checkValidatedCode']);
        Permission::create(['name' => 'request-setStatusForRequestAndItsRequestDetails']);
        Permission::create(['name' => 'request-showDeliveriesStatus']);
        Permission::create(['name' => 'request-showDeliveriesStatusWithoutDelivery']);
        Permission::create(['name' => 'request-showDeliveriesStatusWithDelivery']);
        Permission::create(['name' => 'request-getAllCancelStatus']);
        Permission::create(['name' => 'request-getAllIsNotArchiveAndCancelStatus']);
        Permission::create(['name' => 'request-getAllDetailsById']);
        Permission::create(['name' => 'request-getAllForWarehouseDeliveryId']);
        Permission::create(['name' => 'request-processOfSetReturnToWarehouseStatus']);
        Permission::create(['name' => 'request-processOfSetReturnDeliveryId']);
        Permission::create(['name' => 'request-processOfValidCodeForReturnToDelivery']);
        Permission::create(['name' => 'request-processOfValidCodeForReturnToWarehouse']);
        Permission::create(['name' => 'request-storeRequestAndRequestDetailsWithoutConfirms']);
        Permission::create(['name' => 'request-getAllReturnToWarehouseStatus']);

        Permission::create(['name' => 'user-list']);
        Permission::create(['name' => 'user-store']);
        Permission::create(['name' => 'user-delete']);
        Permission::create(['name' => 'user-update']);
        Permission::create(['name' => 'user-status']);

        Permission::create(['name' => 'warehouse-cartable']);
        Permission::create(['name' => 'warehouse-list']);
        Permission::create(['name' => 'warehouse-store']);
        Permission::create(['name' => 'warehouse-delete']);
        Permission::create(['name' => 'warehouse-update']);

        Permission::create(['name' => 'vehicle-list']);
        Permission::create(['name' => 'vehicle-store']);
        Permission::create(['name' => 'vehicle-delete']);
        Permission::create(['name' => 'vehicle-update']);

        Permission::create(['name' => 'usersConfirm-list']);
        Permission::create(['name' => 'usersConfirm-getByUserId']);
        Permission::create(['name' => 'usersConfirm-store']);
        Permission::create(['name' => 'usersConfirm-delete']);
        Permission::create(['name' => 'usersConfirm-update']);

        Permission::create(['name' => 'unit-list']);
        Permission::create(['name' => 'unit-store']);
        Permission::create(['name' => 'unit-delete']);
        Permission::create(['name' => 'unit-update']);

        Permission::create(['name' => 'status-list']);
        Permission::create(['name' => 'status-store']);
        Permission::create(['name' => 'status-delete']);
        Permission::create(['name' => 'status-update']);

        Permission::create(['name' => 'requestsDetailsConfirm-list']);
        Permission::create(['name' => 'requestsDetailsConfirm-store']);
        Permission::create(['name' => 'requestsDetailsConfirm-delete']);
        Permission::create(['name' => 'requestsDetailsConfirm-update']);
        Permission::create(['name' => 'requestsDetailsConfirm-confirmsOfRequestDetail']);
        Permission::create(['name' => 'requestsDetailsConfirm-confirmsOfRequest']);
        Permission::create(['name' => 'requestsDetailsConfirm-updateByRequestDetailIdUserIdAndConfirmId']);

        Permission::create(['name' => 'requestsConfirm-list']);
        Permission::create(['name' => 'requestsConfirm-store']);
        Permission::create(['name' => 'requestsConfirm-delete']);
        Permission::create(['name' => 'requestsConfirm-update']);
        Permission::create(['name' => 'requestsConfirm-storeById']);

        Permission::create(['name' => 'productsConfirm-list']);
        Permission::create(['name' => 'productsConfirm-store']);

        Permission::create(['name' => 'product-list']);
        Permission::create(['name' => 'product-store']);
        Permission::create(['name' => 'product-delete']);
        Permission::create(['name' => 'product-update']);

        Permission::create(['name' => 'file-list']);
        Permission::create(['name' => 'file-store']);
        Permission::create(['name' => 'file-delete']);
        Permission::create(['name' => 'file-update']);

        Permission::create(['name' => 'delivery-cartable']);
        Permission::create(['name' => 'delivery-list']);
        Permission::create(['name' => 'delivery-store']);
        Permission::create(['name' => 'delivery-delete']);
        Permission::create(['name' => 'delivery-update']);

        Permission::create(['name' => 'confirm-list']);
        Permission::create(['name' => 'confirm-store']);
        Permission::create(['name' => 'confirm-delete']);
        Permission::create(['name' => 'confirm-update']);

        Permission::create(['name' => 'category-list']);
        Permission::create(['name' => 'category-store']);
        Permission::create(['name' => 'category-delete']);
        Permission::create(['name' => 'category-update']);

        Permission::create(['name' => 'categoryConfirm-list']);
        Permission::create(['name' => 'categoryConfirm-store']);
        Permission::create(['name' => 'categoryConfirm-delete']);
        Permission::create(['name' => 'categoryConfirm-update']);

        Permission::create(['name' => 'buysDetail-list']);
        Permission::create(['name' => 'buysDetail-store']);
        Permission::create(['name' => 'buysDetail-delete']);
        Permission::create(['name' => 'buysDetail-update']);

        Permission::create(['name' => 'buysconfirms-list']);
        Permission::create(['name' => 'buysconfirms-store']);
        Permission::create(['name' => 'buysconfirms-delete']);
        Permission::create(['name' => 'buysconfirms-update']);

        Permission::create(['name' => 'buy-list']);
        Permission::create(['name' => 'buy-store']);
        Permission::create(['name' => 'buy-delete']);
        Permission::create(['name' => 'buy-update']);

        Permission::create(['name' => 'center-list']);
        Permission::create(['name' => 'center3-list']);

        Permission::create(['name' => 'permission-list']);
        Permission::create(['name' => 'permission-loginUser']);

        Permission::create(['name' => 'role-addToUser']);
        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-assignPermissionToRole']);

        Permission::create(['name' => 'warehouseDelivery-list']);
        Permission::create(['name' => 'warehouseDelivery-store']);
        Permission::create(['name' => 'warehouseDelivery-delete']);
        Permission::create(['name' => 'warehouseDelivery-update']);

        Permission::create(['name' => 'itemConsumptionType-list']);

        //dashboard menu
        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'manage-rolepermission']);
        Permission::create(['name' => 'bahrevari-automation']);
        Permission::create(['name' => 'feeding-automation']);
        Permission::create(['name' => 'salary-automation']);
        Permission::create(['name' => 'bone_automation']);
        Permission::create(['name' => 'setting']);
    }
}
