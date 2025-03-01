<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDetailsEditLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $ignore=['id','created_at','updated_at'];
        $tableFields = Schema::getColumnListing($table='requests_details');
        $tableCreateFields = array_diff($tableFields, $ignore);
        
        Schema::create('request_details_edit_logs', function (Blueprint $table) use($tableCreateFields){
            $table->id();
            $table->integer('requests_details_id');
            $table->integer('user_id');
            $table->string('flag');
            foreach($tableCreateFields as $field){
                $table->string($field)->nullable();
            }
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
        Schema::dropIfExists('request_details_edit_logs');
    }
}
