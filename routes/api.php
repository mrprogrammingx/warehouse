<?php

use App\Http\Controllers\Api\CenterController;
use App\Http\Controllers\Api\BuyController;
use App\Http\Controllers\Api\BuysConfirmController;
use App\Http\Controllers\Api\BuysDetailController;
use App\Http\Controllers\Api\CategoriesConfirmController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\Center3Controller;
use App\Http\Controllers\Api\ConfirmController;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\ItemConsumptionTypeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RequestController;
use App\Http\Controllers\Api\RequestDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\JWTAuthController;
use App\Http\Controllers\Api\MeasureUnitController;
use App\Http\Controllers\Api\ProductsConfirmController;
use App\Http\Controllers\Api\RequestsConfirmController;
use App\Http\Controllers\Api\RequestsDetailsConfirmController;
use App\Http\Controllers\Api\RolePermission\PermissionController;
use App\Http\Controllers\Api\RolePermission\RoleController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UsersConfirmController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Rayvarz\ProductController as RayvarzProductController;
use App\Http\Controllers\Rayvarz\RemittanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\MainDashboard\FoodController;
use App\Http\Controllers\Api\WarehouseDeliveryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('user/updateOrStoreByPersonnelCode', [UserController::class,'updateOrStoreByPersonnelCode']);

//Route::get('/authenticate', [JWTAuthController::class, 'loginByToken']);


Route::group(['middleware' => 'rayvarz'], function ($router) {
    Route::get('/rayvarz/products/last', [RayvarzProductController::class, 'getLastProducts']);
    Route::put('/rayvarz/product/sync', [RayvarzProductController::class, 'syncWarehouseProductTableWithRayvarz']);
    Route::get('/rayvarz/product/amount', [RayvarzProductController::class, 'checkAmountOfEachProduct']);
    Route::post('/rayvarz/remittance/create', [RemittanceController::class, 'createRemittance']);
});

Route::post('/login', [JWTAuthController::class, 'login']);
Route::post('/register', [JWTAuthController::class, 'register']);

Route::group(['middleware' => 'jwt.verify'], function ($router) {

    Route::post('/logout', [JWTAuthController::class, 'logout']);
    Route::post('/refresh', [JWTAuthController::class, 'refresh']);
    Route::post('/profile', [JWTAuthController::class, 'profile']);
    Route::get('/getUser', [JWTAuthController::class, 'getUser']);

    Route::controller(ProductController::class)->group(function () {
        Route::get('products/all', 'getAll')->middleware(['permission:product-list']);
        Route::post('products/store', 'store')->middleware(['permission:product-store']);
        Route::delete('products/delete/{id}', 'delete')->middleware(['permission:product-delete']);
        Route::put('products/update', 'update')->middleware(['permission:product-update']);
        Route::get('products/productsByWarehouseId', 'getProductsByWarehouseId')->middleware(['permission:product-list']);
        Route::get('products/allRecordsOfProductById', 'getAllRecordsOfProductById')->middleware(['permission:product-list']);
    });

    Route::controller(RequestController::class)->group(function () {
        Route::get('requests/all', 'getAll')->middleware(['permission:request-list|request-store|request-update|request-delete']);
        Route::post('requests/store', 'store')->middleware(['permission:request-store']);
        Route::delete('requests/delete/{id}', 'delete')->middleware(['permission:request-delete']);
        Route::put('requests/update', 'update')->middleware(['permission:request-update']);
        Route::post('request/RequestDetails/store', 'storeRequestAndRequestDetails')->middleware(['permission:request-storeRequestAndRequestDetails']);
        Route::post('getCurrentDate', 'getCurrentDate')->middleware(['permission:request-getCurrentDate']);
        Route::get('requests/user', 'allRequestsOfUserId')->middleware(['permission:request-allRequestsOfUserId']);
        Route::get('requests/confirms/user', 'allRequestConfirmsByUserId')->middleware(['permission:request-allRequestConfirmsByUserId']);
        Route::get('requests/delivery', 'allRequestsByDeliveryId')->middleware(['permission:request-allRequestsByDeliveryId']);
        Route::get('requests/userConfirms', 'allConfirmsOfUserId')->middleware(['permission:request-allConfirmsOfUserId']);
        Route::get('requests/confirmed', 'requestIsConfirmed')->middleware(['permission:request-list|request-store|request-update|request-delete']);
        Route::get('requests/getAllArchiveStatus', 'getAllArchiveStatus')->middleware(['permission:request-getAllArchiveStatus']);
        Route::get('requests/getAllCancelStatus', 'getAllCancelStatus')->middleware(['permission:request-getAllCancelStatus']);
        Route::get('requests/getAllIsNotArchiveStatus', 'getAllIsNotArchiveStatus')->middleware(['permission:request-getAllIsNotArchiveStatus']);
        Route::get('requests/getAllIsNotArchiveAndCancelStatus', 'getAllIsNotArchiveAndCancelStatus')->middleware(['permission:request-getAllIsNotArchiveAndCancelStatus']);
        Route::get('requests/checkValidatedCode', 'checkValidatedCode')->middleware(['permission:request-checkValidatedCode']);
        Route::put('requests/statusRequestAndItsRequestDetails/{statusId}', 'setStatusForRequestAndItsRequestDetails')->middleware(['permission:request-setStatusForRequestAndItsRequestDetails']);
        Route::get('requests/deliveriesStatus', 'showDeliveriesStatus')->middleware(['permission:request-showDeliveriesStatus']);
        Route::get('requests/deliveriesStatusWithoutDelivery', 'showDeliveriesStatusWithoutDelivery')->middleware(['permission:request-showDeliveriesStatusWithoutDelivery']);
        Route::get('requests/deliveriesStatusWithDelivery', 'showDeliveriesStatusWithDelivery')->middleware(['permission:request-showDeliveriesStatusWithDelivery']);
        Route::get('requests/archivedRequestsOfUserId', 'archivedRequestsOfUserId')->middleware(['permission:request-list|request-store|request-update|request-delete']);
        Route::get('requests/notArchivedRequestsOfUserId', 'notArchivedRequestsOfUserId')->middleware(['permission:request-list|request-store|request-update|request-delete']);
        Route::put('requests/setWarehouseDeliveryId', 'setWarehouseDeliveryId')->middleware(['permission:request-setWarehouseDeliveryId']);
        Route::get('requests/getAllDetailsById', 'getAllDetailsById')->middleware(['permission:request-getAllDetailsById']);
        Route::get('requests/getAllForWarehouseDeliveryId', 'getAllForWarehouseDeliveryId')->middleware(['permission:request-getAllForWarehouseDeliveryId']);
        Route::put('requests/processOfSetReturnToWarehouseStatus', 'processOfSetReturnToWarehouseStatus')->middleware(['permission:request-processOfSetReturnToWarehouseStatus']);
        Route::put('requests/processOfSetReturnDeliveryId', 'processOfSetReturnDeliveryId')->middleware(['permission:request-processOfSetReturnDeliveryId']);
        Route::put('requests/processOfValidCodeForReturnToDelivery', 'processOfValidCodeForReturnToDelivery')->middleware(['permission:request-processOfValidCodeForReturnToDelivery']);
        Route::put('requests/processOfValidCodeForReturnToWarehouse', 'processOfValidCodeForReturnToWarehouse')->middleware(['permission:request-processOfValidCodeForReturnToWarehouse']);
        Route::post('requests/storeRequestAndRequestDetailsWithoutConfirms', 'storeRequestAndRequestDetailsWithoutConfirms')->middleware(['permission:request-storeRequestAndRequestDetailsWithoutConfirms']);
        Route::get('requests/getAllReturnToWarehouseStatus', 'getAllReturnToWarehouseStatus')->middleware(['permission:request-getAllReturnToWarehouseStatus']);
    });

    Route::controller(RequestDetailController::class)->group(function () {
        Route::get('requestdetails/all', 'getAll')->middleware(['permission:requestDetail-list|requestDetail-store|requestDetail-update|requestDetail-delete']);
        Route::post('requestdetails/store', 'store')->middleware(['permission:requestDetail-store']);
        Route::delete('requestdetails/delete/{id}', 'delete')->middleware(['permission:requestDetail-delete']);
        Route::put('requestdetails/update', 'update')->middleware(['permission:requestDetail-update']);
        Route::put('requestdetails/updateDeliveryId', 'updateDeliveryId')->middleware(['permission:requestDetail-updateDeliveryId']);
        Route::get('requestdetails/confirmed', 'requestDetailIsConfirmed')->middleware(['permission:requestDetail-list|requestDetail-store|requestDetail-update|requestDetail-delete']);
        Route::put('requestdetails/setDelivered', 'setDelivered')->middleware(['permission:requestDetail-setDelivered']);
        Route::put('requestdetails/updateWarehouseDeliveryId', 'updateWarehouseDeliveryId')->middleware(['permission:requestDetail-updateWarehouseDeliveryId']);
    });

    Route::controller(BuysConfirmController::class)->group(function () {
        Route::get('buysconfirms/all', 'getAll')->middleware(['permission:buysconfirms-list']);
        Route::post('buysconfirms/store', 'store')->middleware(['permission:buysconfirms-store']);
        Route::delete('buysconfirms/delete/{id}', 'delete')->middleware(['permission:buysconfirms-delete']);
        Route::put('buysconfirms/update', 'update')->middleware(['permission:buysconfirms-update']);
    });

    Route::controller(BuysDetailController::class)->group(function () {
        Route::get('buysDetail/all', 'getAll')->middleware(['permission:buysDetail-list']);
        Route::post('buysDetail/store', 'store')->middleware(['permission:buysDetail-store']);
        Route::delete('buysDetail/delete/{id}', 'delete')->middleware(['permission:buysDetail-delete']);
        Route::put('buysDetail/update', 'update')->middleware(['permission:buysDetail-update']);
    });

    Route::controller(BuyController::class)->group(function () {
        Route::get('buys/all', 'getAll')->middleware(['permission:buy-list']);
        Route::post('buys/store', 'store')->middleware(['permission:buy-store']);
        Route::delete('buys/delete/{id}', 'delete')->middleware(['permission:buy-delete']);
        Route::put('buys/update', 'update')->middleware(['permission:buy-update']);
    });

    Route::controller(ConfirmController::class)->group(function () {
        Route::get('confirms/all', 'getAll')->middleware(['permission:confirm-list']);
        Route::post('confirms/store', 'store')->middleware(['permission:confirm-store']);
        Route::delete('confirms/delete/{id}', 'delete')->middleware(['permission:confirm-delete']);
        Route::put('confirms/update', 'update')->middleware(['permission:confirm-update']);
    });

    Route::controller(UsersConfirmController::class)->group(function () {
        Route::get('usersConfirms/all', 'getAll')->middleware(['permission:usersConfirm-list|usersConfirm-store|usersConfirm-update|usersConfirm-delete']);
        Route::post('usersConfirms/store', 'store')->middleware(['permission:usersConfirm-store']);
        Route::delete('usersConfirms/delete/{id}', 'delete')->middleware(['permission:usersConfirm-delete']);
        Route::put('usersConfirms/update', 'update')->middleware(['permission:usersConfirm-update']);
        Route::get('usersConfirms/userId', 'getByUserId')->middleware(['permission:usersConfirm-list|usersConfirm-getByUserId|usersConfirm-store|usersConfirm-update|usersConfirm-delete']);
        Route::put('usersConfirms/setInactiveStatusByUserConfirmId', 'setInactiveStatusByUserConfirmId')->middleware(['permission:usersConfirm-update']);
    });

    Route::controller(FileController::class)->group(function () {
        Route::get('file/all', 'getAll')->middleware(['permission:file-list']);
        Route::post('file/store', 'store')->middleware(['permission:file-store']);
        Route::delete('file/delete/{id}', 'delete')->middleware(['permission:file-delete']);
        Route::put('file/update', 'update')->middleware(['permission:file-update']);
        Route::post('file/storeInStorageAndTable', 'storeFileInStorageAndFileTable')->middleware(['permission:file-store']);
    });

    Route::controller(RequestsConfirmController::class)->group(function () {
        Route::get('requestsConfirm/all', 'getAll')->middleware(['permission:requestsConfirm-list|requestsConfirm-store|requestsConfirm-update|requestsConfirm-delete']);
        Route::post('requestsConfirm/store', 'store')->middleware(['permission:requestsConfirm-store']);
        Route::delete('requestsConfirm/delete/{id}', 'delete')->middleware(['permission:requestsConfirm-delete']);
        Route::put('requestsConfirm/update', 'update')->middleware(['permission:requestsConfirm-update']);
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('category/all', 'getAll')->middleware(['permission:category-list']);
        Route::post('category/store', 'store')->middleware(['permission:category-store']);
        Route::delete('category/delete/{id}', 'delete')->middleware(['permission:category-delete']);
        Route::put('category/update', 'update')->middleware(['permission:category-update']);
    });

    Route::controller(CategoriesConfirmController::class)->group(function () {
        Route::get('categoryConfirm/all', 'getAll')->middleware(['permission:categoryConfirm-list']);
        Route::post('categoryConfirm/store', 'store')->middleware(['permission:categoryConfirm-store']);
        Route::delete('categoryConfirm/delete/{id}', 'delete')->middleware(['permission:categoryConfirm-delete']);
        Route::put('categoryConfirm/update', 'update')->middleware(['permission:categoryConfirm-update']);
    });

    Route::controller(WarehouseController::class)->group(function () {
        Route::get('warehouse/all', 'getAll')->middleware(['permission:warehouse-list|warehouse-store|warehouse-update|warehouse-delete']);
        Route::post('warehouse/store', 'store')->middleware(['permission:warehouse-store']);
        Route::delete('warehouse/delete/{id}', 'delete')->middleware(['permission:warehouse-delete']);
        Route::put('warehouse/update', 'update')->middleware(['permission:warehouse-update']);
        Route::get('warehouse/allActive', 'getAllActiveWarehouses')->middleware(['permission:warehouse-list']);
    });

    Route::controller(DeliveryController::class)->group(function () {
        Route::get('delivery/all', 'getAll')->middleware(['permission:delivery-list']);
        Route::post('delivery/store', 'store')->middleware(['permission:delivery-store']);
        Route::delete('delivery/delete/{id}', 'delete')->middleware(['permission:delivery-delete']);
        Route::put('delivery/update', 'update')->middleware(['permission:delivery-update']);
        Route::put('delivery/updateOnlineStatus', 'updateOnlineStatus')->middleware(['permission:delivery-update']);
    });

    Route::controller(StatusController::class)->group(function () {
        Route::get('status/all', 'getAll')->middleware(['permission:status-list|status-store|status-update|status-delete']);
        Route::post('status/store', 'store')->middleware(['permission:status-store']);
        Route::delete('status/delete/{id}', 'delete')->middleware(['permission:status-delete']);
        Route::put('status/update', 'update')->middleware(['permission:status-update']);
    });

    Route::controller(VehicleController::class)->group(function () {
        Route::get('vehicle/all', 'getAll')->middleware(['permission:vehicle-list|vehicle-store|vehicle-update|vehicle-delete']);
        Route::post('vehicle/store', 'store')->middleware(['permission:vehicle-store']);
        Route::delete('vehicle/delete/{id}', 'delete')->middleware(['permission:vehicle-delete']);
        Route::put('vehicle/update', 'update')->middleware(['permission:vehicle-update']);
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('user/all', 'getAll')->middleware(['permission:user-list|user-store|user-update|user-delete']);
        Route::get('user/getById', 'getById')->middleware(['permission:user-list|user-store|user-update|user-delete']);
        Route::post('user/store', 'store')->middleware(['permission:user-store']);
        Route::delete('user/delete/{id}', 'delete')->middleware(['permission:user-delete']);
        Route::put('user/update', 'update')->middleware(['permission:user-update']);
        Route::post('user/change/status', 'changeUserStatus')->middleware(['permission:user-update']);
        // Route::post('user/updateOrStoreByPersonnelCode', 'updateOrStoreByPersonnelCode')->middleware(['permission:user-update']);
    });

    Route::controller(RequestsDetailsConfirmController::class)->group(function () {
        Route::get('requestDetailsConfirms/all', 'getAll')->middleware(['permission:requestsDetailsConfirm-list|requestsDetailsConfirm-store|requestsDetailsConfirm-update|requestsDetailsConfirm-delete']);
        Route::get('requestDetailsConfirms/confirmsOfRequestDetail', 'confirmsOfRequestDetail')->middleware(['permission:requestsDetailsConfirm-confirmsOfRequestDetail']);
        Route::get('requestDetailsConfirms/confirmsOfRequest', 'confirmsOfRequest')->middleware(['permission:requestsDetailsConfirm-confirmsOfRequest']);
        Route::post('requestDetailsConfirms/store', 'store')->middleware(['permission:requestsDetailsConfirm-store']);
        Route::delete('requestDetailsConfirms/delete/{id}', 'delete')->middleware(['permission:requestsDetailsConfirm-delete']);
        Route::put('requestDetailsConfirms/update', 'update')->middleware(['permission:requestsDetailsConfirm-update']);
        Route::put('requestDetailsConfirms/updateByRequestDetailUserConfirmId', 'updateByRequestDetailIdUserIdAndConfirmId')->middleware(['permission:requestsDetailsConfirm-updateByRequestDetailIdUserIdAndConfirmId']);
    });

    Route::controller(ProductsConfirmController::class)->group(function () {
        Route::get('productsConfirm/all', 'getAll')->middleware(['permission:productsConfirm-list']);
        Route::post('productsConfirm/store', 'store')->middleware(['permission:productsConfirm-store']);
        Route::get('productsConfirm/productId', 'getByProductId')->middleware(['permission:productsConfirm-list']);
    });

    Route::controller(UnitController::class)->group(function () {
        Route::get('unit/all', 'getAll')->middleware(['permission:unit-list|unit-store|unit-update|unit-delete']);
        Route::post('unit/store', 'store')->middleware(['permission:unit-store']);
        Route::delete('unit/delete/{id}', 'delete')->middleware(['permission:unit-delete']);
        Route::put('unit/update', 'update')->middleware(['permission:unit-update']);
    });

    Route::controller(MeasureUnitController::class)->group(function () {
        Route::get('measureUnit/all', 'getAll')->middleware(['permission:measureUnit-list|measureUnit-store|measureUnit-update|measureUnit-delete']);
        Route::post('measureUnit/store', 'store')->middleware(['permission:measureUnit-store']);
        Route::delete('measureUnit/delete/{id}', 'delete')->middleware(['permission:measureUnit-delete']);
        Route::put('measureUnit/update', 'update')->middleware(['permission:measureUnit-update']);
    });

    Route::controller(CenterController::class)->group(function (){
        Route::get('center/all','getAll')->middleware(['permission:center-list']);
        Route::get('center/allActive','getAllActive')->middleware(['permission:center-list']);
    });

    Route::controller(Center3Controller::class)->group(function (){
        Route::get('center3/allActive','getAllActive')->middleware(['permission:center3-list']);
    });

    Route::controller(ItemConsumptionTypeController::class)->group(function (){
        Route::get('itemConsumptionType/allActive','getAllActive')->middleware(['permission:itemConsumptionType-list']);
    });

    

    Route::controller(PermissionController::class)->group(function (){
        Route::get('permissions/all','getAllPermissions')->middleware(['permission:permission-list']);
        Route::get('permissions/loginUser','getLoginUserPermissions')->middleware(['permission:permission-loginUser']);
    });

    Route::controller(RoleController::class)->group(function (){
        Route::put('role/addRoleToUser','addRoleToUser')->middleware(['permission:role-addToUser']);
        Route::get('roles/all','getAllRoles')->middleware(['permission:role-list']);
        Route::get('role/assignPermissionToRole','assignPermissionToRole')->middleware(['permission:role-assignPermissionToRole']);
    });

    Route::controller(WarehouseDeliveryController::class)->group(function () {
        Route::get('warehouseDelivery/all', 'getAll')->middleware(['permission:warehouseDelivery-list|warehouseDelivery-store|measureUnit-update|warehouseDelivery-delete']);
        Route::post('warehouseDelivery/store', 'store')->middleware(['permission:warehouseDelivery-store']);
        Route::delete('warehouseDelivery/delete/{id}', 'delete')->middleware(['permission:warehouseDelivery-delete']);
        Route::put('warehouseDelivery/update', 'update')->middleware(['permission:warehouseDelivery-update']);
    });


    Route::controller(FoodController::class)->group(function () {
        Route::get('food/delivery/statistics/count','getCountOfDeliveryReservationPerDayOfWeek');
        Route::get('food/reservation/statistics/count','getCountOfReservationPerDayOfWeek');
    });


    Route::post('authenticate',[JWTAuthController::class,'redirectAndAuth']); // use in manager component

});
