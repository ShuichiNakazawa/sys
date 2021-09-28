<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_sentences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subject_id')->nullable()->default(99);         // 科目名ID
            $table->integer('title_id')->default(99);                       // 問題集タイトルID
            $table->integer('question_number');                             // 問題番号
            $table->integer('answer_id');                                   // 正解ID
            $table->string('answer_sentence');                              // 正解文
            $table->string('sight_key');                                    // サイトキー
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
        Schema::dropIfExists('answer_sentences');
    }
}
