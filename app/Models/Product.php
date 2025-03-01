<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'Attributes',
        'worn',
        'descriptions',
        'file_id',
        'category_id',
        'rayvarz_id',
        'technical_index_id',
        'isValidationsApplied',
        'itemDataId',
        'isInactive',
        'nameEN',
        'unitId',
        'unit',
        'equivalentItemId',
        'itemGroupId',
        'itemGroup',
        'technicalNo',  
        'mapNo',
        'attachmentId',
        'isProduct',
        'isPart',
        'isTool',
        'isPacking',
        'isLaboratoryEquipment',
        'isShop',
        'isFixedAsset',
        'isMold',
        'isMaterial',
        'isService',
        'isAccessories',
        'isConsumable',
        'isOldPartRequired',
        'isStandardRequestProduct',
        'isFeedable',
        'isCuttable',
        'isSemiProduct',
        'supplierId',
        'supplier',
        'centerId',
        'center',
        'defaultCenterId',
        'defaultCenter',
        'itemCode',
        'itemReceiptTypeId',
        'itemReceiptType',
        'itemConsumptionTypeId',
        'itemConsumptionType',
        'itemMaintenanceId',
        'itemMaintenance',
        'itemImportanceId',
        'itemImportance',
        'itemUseConditionId',
        'itemUseCondition',
        'itemProductionStateId',
        'itemProductionState',
        'itemTransportationTypeId',
        'itemTransportationType',
        'itemPackageTypeId',
        'itemPackageType',
        'orderTypeId',
        'orderType',
        'defaultInventoryOrderId',
        'defaultInventoryOrder',
        'orderPoint',
        'orderSpanTime',
        'orderOptimumQty',
        'orderMinimumQty',
        'monthlyConsumeAverage',
        'expireDuration',
        'orderWaitDuration',
        'toolMinuteRate',
        'safetyStock',
        'bulkUnitId',
        'bulkUnit',
        'bulkToPieceConvertRate',
        'orderUnitId',
        'orderUnit',
        'orderToInventoryConvertRate',
        'bomUnitId',
        'bomUnit',
        'bomToInventoryConvertRate',
        'salesBulkUnitId',
        'salesBulkUnit',
        'salesPieceUnitId',
        'salesPieceUnit',
        'salesBulkToPieceConvertRate',
        'salesBulkToInventoryConvertRate',
        'salesPieceToInventoryConvertRate',
        'netWeight',
        'grossWeight',
        'containerWeight',
        'weightUnitId',
        'weightUnit',
        'length',
        'lengthUnitId',
        'lengthUnit',
        'width',
        'widthUnitId',
        'widthUnit',
        'height',
        'heightUnitId',
        'heightUnit',
        'itemCharacteristic1Id',
        'itemCharacteristic1',
        'itemCharacteristic2Id',
        'itemCharacteristic2',
        'itemCharacteristic3Id',
        'itemCharacteristic3',
        'itemCharacteristic4Id',
        'itemCharacteristic4',
        'defaultActivity3CenterId',
        'defaultActivity3Center',
        'tariffNo',
        'itemNationalCode',
        'arrivalItemExcessPercent',
        'allotmentPercent',
        'allotmentAmount',
        'leadTime',
        'purityDegree',
        'purityDegreeRate',
        'shippingMinimumCapacity',
        'deliveryExcessQty',
        'productionPercent',
        'salesToDistributionConvertRate',
        'packingWeigthUnitId',
        'mrpPurityDegree',
        'remarks',
        'creationDate',
        'lastModifiedDate',
        'estimationPrice',
        'costAccountingTemplateId',
        'salesReservedStock',
        'assetsClassificationId',
        'assetsClassification',
        'depreciationTypeId',
        'depreciationType',
        'usefulLifetime',
        'usefulLifetimeUnitId',
        'assetsDescendingDepreciationRate',
        'productionItemTypeId',
        'productionItemType',
        'productionItemGroupId',
        'productionItemGroup',
        'maxFeed',
        'minFeed',
        'seasonalTradePartType',
        'codingClassificationId'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'attributes' => 'json',
    ];

    /**
     * The fields of our database, they are not in rayvarz
     * 
     * @var array
     */
    protected $ourFields = [
        'attributes',
        'worn',
        'descriptions',
        'file_id',
        'category_id',
        'rayvarz_id',
        'technical_index_id'
    ];

    public function getOurFields(){
        return $this->ourFields;
    }
    
    public function request_detail(){
        return $this->belongsTo(RequestDetail::class,'product_id','id');
    }

    public function productsConfirm(){
        return $this->hasMany(ProductsConfirm::class);
    }
}
