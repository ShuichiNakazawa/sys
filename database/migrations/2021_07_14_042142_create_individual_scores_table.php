<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');             // ユーザーID
            $table->integer('subject_name_id');     // 科目名ID
            $table->integer('question_title_id');   // 問題タイトルID
            $table->integer('question_number');     // 問題番号
            $table->integer('number_judgement');    // 判定回数
            $table->integer('judgement');           // 正誤フラグ
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
        Schema::dropIfExists('individual_scores');
    }
}
