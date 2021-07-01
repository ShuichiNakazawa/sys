<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMDeptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_depts', function (Blueprint $table) {
            $table->bigIncrements('id');        // ID
            $table->string('name_of_dept');     // 部門名称
            $table->string('editor');           // 登録者
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
        Schema::dropIfExists('m_depts');
    }
}
