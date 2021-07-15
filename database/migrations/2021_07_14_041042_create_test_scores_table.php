<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_scores', function (Blueprint $table) {
            $table->bigIncrements('id');                // ID
            $table->integer('user_id');                 // ユーザID
            $table->integer('subject_name_id');         // 科目名ID
            $table->integer('question_title_id');       // 問題タイトルID
            $table->integer('number_try');              // 挑戦回数
            $table->decimal('score');                   // 得点
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
        Schema::dropIfExists('test_scores');
    }
}
