<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::defaultStringLength(191); 
        Schema::create('products', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->innodb_large_prefix = 1;
            $table->innodb_file_format = 'barracuda';
            $table->innodb_file_format_max = 'barracuda';
            $table->innodb_file_per_table = 1;
            $table->engine = 'InnoDB ROW_FORMAT=DYNAMIC';
            $table->id();
            $table->json('attributes')->nullable();
            $table->boolean('worn')->nullable();
            $table->string('descriptions')->nullable();
            $table->integer('file_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('rayvarz_id')->nullable();
            $table->string('technical_index_id')->nullable();
            //rayvarz_field
            $table->string('isValidationsApplied')->nullable();//
            $table->string('itemDataId',20)->nullable();
            $table->tinyInteger('isInactive')->nullable();
            $table->string('name',8000)->nullable();
            $table->string('nameEN',255)->nullable();
            $table->char('unitId',2)->nullable();
            $table->string('unit')->nullable();//
            $table->string('equivalentItemId',20)->nullable();
            $table->string('itemGroupId',20)->nullable();
            $table->string('itemGroup')->nullable();//
            $table->string('technicalNo',60)->nullable();
            $table->string('mapNo',60)->nullable();
            $table->char('attachmentId',36)->nullable();
            $table->tinyInteger('isProduct')->nullable();
            $table->tinyInteger('isPart')->nullable();
            $table->tinyInteger('isTool')->nullable();
            $table->tinyInteger('isPacking')->nullable();
            $table->tinyInteger('isLaboratoryEquipment')->nullable();
            $table->tinyInteger('isShop')->nullable();
            $table->tinyInteger('isFixedAsset')->nullable();
            $table->tinyInteger('isMold')->nullable();
            $table->tinyInteger('isMaterial')->nullable();
            $table->tinyInteger('isService')->nullable();
            $table->tinyInteger('isAccessories')->nullable();
            $table->tinyInteger('isConsumable')->nullable();
            $table->tinyInteger('isOldPartRequired')->nullable();
            $table->tinyInteger('isStandardRequestProduct')->nullable();
            $table->tinyInteger('isFeedable')->nullable();
            $table->tinyInteger('isCuttable')->nullable();
            $table->tinyInteger('isSemiProduct')->nullable();
            $table->string('supplierId',10)->nullable();
            $table->string('supplier')->nullable();//
            $table->integer('centerId')->nullable();
            $table->string('center')->nullable();//
            $table->integer('defaultCenterId')->nullable();
            $table->string('defaultCenter')->nullable();//
            $table->string('itemCode',10)->nullable();
            $table->integer('itemReceiptTypeId')->nullable();
            $table->string('itemReceiptType')->nullable();//
            $table->integer('itemConsumptionTypeId')->nullable();
            $table->string('itemConsumptionType')->nullable();//
            $table->smallInteger('itemMaintenanceId')->nullable();
            $table->string('itemMaintenance')->nullable();//
            $table->tinyInteger('itemImportanceId')->nullable();
            $table->string('itemImportance')->nullable();//
            $table->tinyInteger('itemUseConditionId')->nullable();
            $table->string('itemUseCondition')->nullable();//
            $table->smallInteger('itemProductionStateId')->nullable();
            $table->string('itemProductionState')->nullable();//
            $table->tinyInteger('itemTransportationTypeId')->nullable();
            $table->string('itemTransportationType')->nullable();//
            $table->smallInteger('itemPackageTypeId')->nullable();
            $table->string('itemPackageType')->nullable();//
            $table->tinyInteger('orderTypeId')->nullable();
            $table->string('orderType')->nullable();//
            $table->bigInteger('defaultInventoryOrderId')->nullable();
            $table->string('defaultInventoryOrder')->nullable();//
            $table->decimal('orderPoint', $precision = 15, $scale = 2)->nullable();
            $table->smallInteger('orderSpanTime')->nullable();
            $table->decimal('orderOptimumQty', $precision = 15, $scale = 2)->nullable();
            $table->decimal('orderMinimumQty', $precision = 15, $scale = 2)->nullable();
            $table->decimal('monthlyConsumeAverage', $precision = 15, $scale = 2)->nullable();
            $table->smallInteger('expireDuration')->nullable();
            $table->smallInteger('orderWaitDuration')->nullable();
            $table->decimal('toolMinuteRate', $precision = 15, $scale = 2)->nullable();
            $table->decimal('safetyStock', $precision = 15, $scale = 2)->nullable();
            $table->char('bulkUnitId',2)->nullable();
            $table->string('bulkUnit')->nullable();//
            $table->decimal('bulkToPieceConvertRate', $precision = 15, $scale = 2)->nullable();
            $table->char('orderUnitId',2)->nullable();
            $table->string('orderUnit')->nullable();//
            $table->float('orderToInventoryConvertRate')->nullable();
            $table->char('bomUnitId',2)->nullable();
            $table->string('bomUnit')->nullable();//
            $table->integer('bomToInventoryConvertRate')->nullable();
            $table->char('salesBulkUnitId',2)->nullable();
            $table->string('salesBulkUnit')->nullable();//
            $table->char('salesPieceUnitId',2)->nullable();
            $table->string('salesPieceUnit')->nullable();//
            $table->float('salesBulkToPieceConvertRate')->nullable();
            $table->float('salesBulkToInventoryConvertRate')->nullable();
            $table->float('salesPieceToInventoryConvertRate')->nullable();
            $table->decimal('netWeight', $precision = 15, $scale = 2)->nullable();
            $table->decimal('grossWeight', $precision = 15, $scale = 2)->nullable();
            $table->decimal('containerWeight', $precision = 15, $scale = 2)->nullable();
            $table->char('weightUnitId',2)->nullable();
            $table->string('weightUnit')->nullable();//
            $table->decimal('length', $precision = 15, $scale = 2)->nullable();
            $table->char('lengthUnitId', 2)->nullable();
            $table->string('lengthUnit')->nullable();//
            $table->decimal('width', $precision = 15, $scale = 2)->nullable();
            $table->char('widthUnitId',2)->nullable();
            $table->string('widthUnit')->nullable();//
            $table->decimal('height', $precision = 15, $scale = 2)->nullable();
            $table->char('heightUnitId',2)->nullable();
            $table->string('heightUnit')->nullable();//
            $table->string('itemCharacteristic1Id',10)->nullable();
            $table->string('itemCharacteristic1')->nullable();//
            $table->string('itemCharacteristic2Id',10)->nullable();
            $table->string('itemCharacteristic2')->nullable();//
            $table->string('itemCharacteristic3Id',10)->nullable();
            $table->string('itemCharacteristic3')->nullable();//
            $table->string('itemCharacteristic4Id',10)->nullable();
            $table->string('itemCharacteristic4')->nullable();//
            $table->string('defaultActivity3CenterId',10)->nullable();
            $table->string('defaultActivity3Center')->nullable();//
            $table->string('tariffNo',10)->nullable();
            $table->string('itemNationalCode',20)->nullable();
            $table->decimal('arrivalItemExcessPercent', $precision = 15, $scale = 2)->nullable();
            $table->decimal('allotmentPercent', $precision = 15, $scale = 2)->nullable();
            $table->decimal('allotmentAmount', $precision = 15, $scale = 2)->nullable();
            $table->smallInteger('leadTime')->nullable();
            $table->decimal('purityDegree', $precision = 15, $scale = 2)->nullable();
            $table->decimal('purityDegreeRate', $precision = 15, $scale = 2)->nullable();
            $table->decimal('shippingMinimumCapacity', $precision = 15, $scale = 2)->nullable();
            $table->decimal('deliveryExcessQty', $precision = 15, $scale = 2)->nullable();
            $table->decimal('productionPercent', $precision = 15, $scale = 2)->nullable();
            $table->decimal('salesToDistributionConvertRate', $precision = 15, $scale = 2)->nullable();
            $table->decimal('packingWeigthUnitId', $precision = 15, $scale = 2)->nullable();
            $table->decimal('mrpPurityDegree', $precision = 15, $scale = 2)->nullable();
            $table->string('remarks',2000)->nullable();
            $table->char('creationDate',8)->nullable();
            $table->char('lastModifiedDate',8)->nullable();
            $table->decimal('estimationPrice', $precision = 15, $scale = 2)->nullable();
            $table->smallInteger('costAccountingTemplateId')->nullable();
            $table->decimal('salesReservedStock', $precision = 15, $scale = 2)->nullable();
            $table->integer('assetsClassificationId')->nullable();
            $table->string('assetsClassification')->nullable();//
            $table->string('depreciationTypeId')->nullable();//
            $table->string('depreciationType')->nullable();//
            $table->integer('usefulLifetime')->nullable();
            $table->tinyInteger('usefulLifetimeUnitId')->nullable();
            $table->decimal('assetsDescendingDepreciationRate', $precision = 15, $scale = 2)->nullable();
            $table->smallInteger('productionItemTypeId')->nullable();
            $table->string('productionItemType')->nullable();//
            $table->string('productionItemGroupId',20)->nullable();
            $table->string('productionItemGroup')->nullable();//
            $table->decimal('maxFeed', $precision = 15, $scale = 2)->nullable();
            $table->decimal('minFeed', $precision = 15, $scale = 2)->nullable();
            $table->tinyInteger('seasonalTradePartType')->nullable();
            $table->integer('codingClassificationId')->nullable();
            /*$table->string('rayGuid')->nullable();
            $table-> ('inventoryOrderCollection')->nullable();
            $table->string('state')->nullable();
            $table->string('lastState')->nullable();
            $table->string('rowVersion')->nullable();
            $table->string('backupOriginalData')->nullable();
            $table->string('rayValidationResults')->nullable();
            $table->string('validationErrors')->nullable();
            $table->string('validationErrorsMessages')->nullable();
            $table->string('metadataRaySystemId')->nullable();
            $table->string('hasMetadata')->nullable();
            $table->string('modifiedProperties')->nullable();
            $table->string('hasErrors')->nullable();
            $table->string('disposing')->nullable();*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
