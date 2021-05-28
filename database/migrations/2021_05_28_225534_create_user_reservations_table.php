<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reservations', function (Blueprint $table) {
            $table->bigIncrements('id');            // ID
            $table->integer('user_id');             // ユーザID
            $table->string('year');                 // 年
            $table->string('month');                // 月
            $table->string('day');                  // 日
            $table->string('timezone');             // 時間
            $table->string('minute');               // 分
            $table->integer('status');              // 状態コード
            $table->string('sight_key');            // サイトキー
            $table->timestamps();                   // タイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_reservations');
    }
}
