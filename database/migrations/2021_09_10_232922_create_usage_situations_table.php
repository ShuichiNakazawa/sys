<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsageSituationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage_situations', function (Blueprint $table) {
            $table->bigIncrements('id');                // ID
            $table->integer('subject_id');              // 科目ID
            $table->integer('title_id');                // タイトルID
            $table->datetime('test_date');              // テスト実施日
            $table->integer('number_challenger');       // 挑戦者数
            $table->decimal('average_score');           // 平均得点
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
        Schema::dropIfExists('usage_situations');
    }
}
