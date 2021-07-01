<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEquipmentTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_equipment_tags', function (Blueprint $table) {
            $table->bigIncrements('id');        // ID
            $table->integer('dept_id');         // 部門ID
            $table->string('name_of_tag');      // タグ名称
            $table->timestamps();               // タイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_equipment_tags');
    }
}
