<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('column_details', function (Blueprint $table) {
            $table->increments('id');
            $table->text('validation')->nullable();
            $table->text('custom_validation')->nullable();
            $table->char('transformer')->nullable();
            $table->char('admin_crud')->nullable();
            $table->char('site_crud')->nullable();
            $table->char('admin_filter')->nullable();
            $table->char('website_filter')->nullable();
            $table->char('html_type' , 50);
            $table->integer('column_id')->unsigned();
            $table->foreign('column_id')->references('id')->on('columns')->onDelete('cascade')->obUpdate('cascade');
            $table->integer('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade')->obUpdate('cascade');
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
        Schema::drop('column_details');
    }
}
