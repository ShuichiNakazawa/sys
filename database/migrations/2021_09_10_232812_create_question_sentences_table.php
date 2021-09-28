<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_sentences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subject_id')->nullable();              // 科目ID
            $table->integer('title_id')->nullable();                // 問題タイトルID
            $table->integer('question_number');                     // 問題番号
            $table->string('question_sentence', 1023)->nullable();  // 問題文
            $table->integer('flag_graph_exists')->nullable();       // 図・表フラグ
            $table->string('image_filename')->nullable();           // 図・表ファイル名
            $table->integer('required_numOfAnswers')->nullable();   // 必須回答の数
            $table->integer('number_of_choices')->nullable();       // 選択肢の数
            $table->integer('number_of_answers')->nullable();       // 正解の数
            $table->string('sight_key')->nullable();                // サイトキー
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
        Schema::dropIfExists('question_sentences');
    }
}
