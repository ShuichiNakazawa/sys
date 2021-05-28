<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');                // ID
            $table->string('year');                     // 年
            $table->string('month');                    // 月
            $table->string('day');                      // 日
            $table->string('timezone');                 // 時間帯
            $table->string('minute');                   // 分
            $table->integer('number_available');        // 予約可能数
            $table->integer('number_accepted');         // 予約受付済数
            $table->string('sight_key');                // サイトキー
            $table->timestamps();                       // タイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
