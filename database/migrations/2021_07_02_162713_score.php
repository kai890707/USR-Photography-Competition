<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Score extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('score', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('photo_id')->comment('圖片ID(外來鍵)');
            $table->foreign('photo_id')->references('id')->on('photo');
            $table->unsignedInteger('user_id')->comment('評審ID(外來鍵)');
            $table->foreign('user_id')->references('id')->on('user');
            $table->string('score_A')->comment("分數1");
            $table->string('score_B')->comment("分數2");
            $table->string('score_C')->comment("分數3");
            $table->text('comments')->comment("評語");
            $table->text('checkValue')->comment("評價CHECKBOX");
            $table->string('status')->comment("評分狀態");
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