<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->increments('id');

            /*
             * the primary relation module
             */

            $table->integer('module_from_id')->unsigned();
            $table->foreign('module_from_id')->references('id')->on('modules')->onDelete('cascade')->obUpdate('cascade');

            /*
             * the foreign relation module
             */

            $table->integer('module_to_id');
            //$table->foreign('module_to_id')->references('id')->on('modules')->onDelete('cascade')->obUpdate('cascade');

            /*
             * id of column that will show in select menu
             * or checkbox
             */

            $table->integer('column_id')->unsigned();
            $table->foreign('column_id')->references('id')->on('columns')->onDelete('cascade')->obUpdate('cascade');


            $table->string('type')->nullable();
            $table->string('input_type')->nullable();
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
        Schema::drop('relations');
    }
}
