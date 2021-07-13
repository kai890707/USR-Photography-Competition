<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Status extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('status', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('photo_id')->comment('圖片ID(外來鍵)');
            $table->foreign('photo_id')->references('id')->on('photo');
            $table->unsignedInteger('user_id')->comment('評審ID(外來鍵)');
            $table->foreign('user_id')->references('id')->on('user');
            $table->string('status')->comment("評分狀態{1:未完成,2:完成}");
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
        //
    }
}