<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_equipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dept_id');                      // 部門ID
            $table->string('name_of_equipment');            // 備品名称
            //$table->integer('stock_quantity');              // 在庫数
            $table->string('image_name');                   // 画像ファイル名
            $table->integer('notification_min_value');      // アラート通知閾値
            $table->datetime('datetime_alert')              // 前回アラート日時
                        ->nullable();
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
        Schema::dropIfExists('m_equipments');
    }
}
