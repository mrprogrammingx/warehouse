<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuysDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buys_details', function (Blueprint $table) {
            $table->id();
            $table->integer('buy_id');
            $table->integer('product_id');
            $table->integer('status_id');
            $table->integer('file_id');
            $table->integer('delivery_id');
            $table->float('amount');
            $table->boolean('worn');
            $table->boolean('confirmed')->nullable()->default(null);
            $table->string('descriptions');
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
        Schema::dropIfExists('buys_details');
    }
}
