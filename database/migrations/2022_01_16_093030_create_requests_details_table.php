<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_details', function (Blueprint $table) {
            $table->id();
            $table->integer('request_id');
            $table->integer('product_id');
            $table->integer('status_id')->nullable();
            $table->integer('delivery_id')->nullable();
            $table->integer('warehouses_id')->nullable();
            $table->integer('warehouse_delivery_id')->nullable();
            $table->float('amount');
            $table->string('location')->nullable()->default('');
            $table->string('center_id')->nullable()->default('');
            $table->string('item_consumption_type_id')->nullable()->default('');
            $table->string('center3_id')->nullable()->default('');
            $table->integer('return_delivery_id')->nullable();
            $table->integer('return_user_id')->nullable();
            $table->boolean('returned')->nullable()->default(0);
            $table->boolean('edited')->nullable()->default(0);
            $table->boolean('not_exist')->nullable()->default(0);
            $table->integer('old_request_id')->nullable()->default(0);
            $table->boolean('changed_product')->nullable()->default(0);
            $table->boolean('worn')->default(0);
            $table->float('worn_amount')->nullable();
            $table->boolean('delivered')->nullable();
            $table->boolean('has_remittance')->nullable()->default(0);
            $table->string('descriptions')->nullable();
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
        Schema::dropIfExists('requests_details');
    }
}
