<?php
namespace App\Interfaces;

interface RolePermissionInterface {

    const DEFAULT_ROLE = 'client';

    const PERMISSIONS_HAS_NOT_ADMIN = [
        'permission-list',
        'role-addToUser',
        'role-list',
        'role-assignPermissionToRole',

        'setting',

        'warehouse-store',
        'warehouse-delete',
        'warehouse-update',

        'delivery-list',
        'delivery-store',
        'delivery-delete',
        'delivery-update',

        'confirm-list',
        'confirm-store',
        'confirm-delete',
        'confirm-update',
        'requestsDetailsConfirm-list',
        'requestsDetailsConfirm-store',
        'requestsDetailsConfirm-delete',
        'requestsDetailsConfirm-update',
        'requestsDetailsConfirm-confirmsOfRequestDetail',
        'requestsDetailsConfirm-confirmsOfRequest',
        'requestsDetailsConfirm-updateByRequestDetailIdUserIdAndConfirmId',
        'usersConfirm-list',
        'usersConfirm-store',
        'usersConfirm-delete',
        'usersConfirm-update',
        'requestsConfirm-list',
        'requestsConfirm-store',
        'requestsConfirm-delete',
        'requestsConfirm-update',
        'requestsConfirm-storeById',
        'productsConfirm-list',
        'productsConfirm-store',
        'categoryConfirm-list',
        'categoryConfirm-store',
        'categoryConfirm-delete',
        'categoryConfirm-update',
        'buysconfirms-list',
        'buysconfirms-store',
        'buysconfirms-delete',
        'buysconfirms-update',
    ];

    const PERMISSIONS_FOR_CLIENT = [
        'requestDetail-list',
        'request-list',
        'request-getCurrentDate',
        'request-allRequestsOfUserId',
        'request-allRequestConfirmsByUserId',
        'request-allConfirmsOfUserId',
        'request-store',
        'request-storeRequestAndRequestDetails',
        'file-store',
        'user-list',
        'warehouse-list',
        'usersConfirm-getByUserId',
        'unit-list',
        'status-list',
        'product-list',
        'file-list',
        'buy-list',
        'center-list',
        'permission-loginUser',

        'salary-automation'
    ];

    const PERMISSIONS_HAS_NOT_DELIVERER_ADMIN = [
        'permission-list',
        'role-addToUser',
        'role-list',
        'role-assignPermissionToRole',

        'setting',

        'warehouse-store',
        'warehouse-delete',
        'warehouse-update',

        'request-update',
        'request-delete',
        'request-allRequestsByDeliveryId',
        'request-getAllArchiveStatus',
        'request-getAllCancelStatus',
        'request-getAllIsNotArchiveStatus',
        'request-getAllIsNotArchiveAndCancelStatus',
        'request-checkValidatedCode',
        'request-setStatusForRequestAndItsRequestDetails',
        'request-showDeliveriesStatus',
        'request-showDeliveriesStatusWithoutDelivery',
        'request-showDeliveriesStatusWithDelivery',
        'request-getAllDetailsById',
        'requestDetail-store',
        'requestDetail-update',
        'requestDetail-updateDeliveryId',
        'requestDetail-setDelivered',
        'requestDetail-delete',
        'requestDetail-updateWarehouseDeliveryId'
    ];

    const PERMISSIONS_FOR_DELIVERER = RolePermissionInterface::PERMISSIONS_FOR_CLIENT;

    const PERMISSIONS_HAS_NOT_WAREHOUSE_ADMIN = [
        'permission-list',
        'role-addToUser',
        'role-list',
        'role-assignPermissionToRole',

        'setting',

        'confirm-list',
        'confirm-store',
        'confirm-delete',
        'confirm-update',
        'requestsDetailsConfirm-list',
        'requestsDetailsConfirm-store',
        'requestsDetailsConfirm-delete',
        'requestsDetailsConfirm-update',
        'requestsDetailsConfirm-confirmsOfRequestDetail',
        'requestsDetailsConfirm-confirmsOfRequest',
        'requestsDetailsConfirm-updateByRequestDetailIdUserIdAndConfirmId',
        'usersConfirm-list',
        'usersConfirm-store',
        'usersConfirm-delete',
        'usersConfirm-update',
        'requestsConfirm-list',
        'requestsConfirm-store',
        'requestsConfirm-delete',
        'requestsConfirm-update',
        'requestsConfirm-storeById',
        'productsConfirm-list',
        'productsConfirm-store',
        'categoryConfirm-list',
        'categoryConfirm-store',
        'categoryConfirm-delete',
        'categoryConfirm-update',
        'buysconfirms-list',
        'buysconfirms-store',
        'buysconfirms-delete',
        'buysconfirms-update',
    ];

    const PERMISSIONS_HAS_NOT_WAREHOUSE_DELIVERER = [
        'permission-list',
        'role-addToUser',
        'role-list',
        'role-assignPermissionToRole',

        'setting',

        'delivery-list',
        'delivery-store',
        'delivery-delete',
        'delivery-update',

        'confirm-list',
        'confirm-store',
        'confirm-delete',
        'confirm-update',
        'requestsDetailsConfirm-list',
        'requestsDetailsConfirm-store',
        'requestsDetailsConfirm-delete',
        'requestsDetailsConfirm-update',
        'requestsDetailsConfirm-confirmsOfRequestDetail',
        'requestsDetailsConfirm-confirmsOfRequest',
        'requestsDetailsConfirm-updateByRequestDetailIdUserIdAndConfirmId',
        'usersConfirm-list',
        'usersConfirm-store',
        'usersConfirm-delete',
        'usersConfirm-update',
        'requestsConfirm-list',
        'requestsConfirm-store',
        'requestsConfirm-delete',
        'requestsConfirm-update',
        'requestsConfirm-storeById',
        'productsConfirm-list',
        'productsConfirm-store',
        'categoryConfirm-list',
        'categoryConfirm-store',
        'categoryConfirm-delete',
        'categoryConfirm-update',
        'buysconfirms-list',
        'buysconfirms-store',
        'buysconfirms-delete',
        'buysconfirms-update',
    ];

    const PERMISSIONS_FOR_WAREHOUSE = RolePermissionInterface::PERMISSIONS_FOR_CLIENT;


}