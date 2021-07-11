<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Photo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('photo', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_id')->comment('組別ID(外來鍵)');
            $table->foreign('group_id')->references('id')->on('group');
            $table->unsignedInteger('applicant_id')->comment('報名者ID(外來鍵)');
            $table->foreign('applicant_id')->references('id')->on('applicant');
            $table->string('name')->comment("圖片名稱");
            $table->string('path')->comment("圖片路徑");
            $table->string('illustrate')->comment("圖片意境說明");
            $table->string('status')->comment("評分狀態{未完成:1;所有評審都評分完畢:2}");
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
