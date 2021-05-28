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
            $table->string('subject_name')->nullable();             // 科目名
            $table->integer('questions_title_id')->nullable();      // 問題タイトルID
            $table->string('questions_title')->nullable();          // 問題タイトル
            $table->integer('question_number');                     // 問題番号
            $table->string('division1')->nullable();                // 分野1
            $table->string('division2')->nullable();                // 分野2
            $table->string('division3')->nullable();                // 分野3
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
