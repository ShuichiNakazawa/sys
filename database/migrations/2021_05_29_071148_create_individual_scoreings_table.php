<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualScoreingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_scorings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');             // ユーザーID
            $table->integer('subject_name_id');     // 科目名ID
            $table->integer('questions_title_id');  // 問題タイトルID
            $table->integer('question_number');     // 問題番号
            $table->integer('how_many_time');       // 回答回数
            $table->integer('is_correct');          // 正解判定
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
        Schema::dropIfExists('individual_scorings');
    }
}
