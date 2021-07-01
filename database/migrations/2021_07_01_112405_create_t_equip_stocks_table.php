<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEquipStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_equip_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');            // ID
            $table->integer('equipment_id');        // 備品ID
            $table->integer('stock_quantity');      // 在庫数
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
        Schema::dropIfExists('t_equip_stocks');
    }
}
