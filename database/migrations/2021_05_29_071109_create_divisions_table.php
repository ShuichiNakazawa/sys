<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            Schema::create('divisions', function (Blueprint $table) {
                $table->bigIncrements('id');                // ID
                $table->integer('subject_name_id');         // 科目ID
                $table->string('division');                 // 分野名
                $table->string('sight_key');                // サイトキー
                $table->timestamps();                       // タイムスタンプ
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions');
    }
}
