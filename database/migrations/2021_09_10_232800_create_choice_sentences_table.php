<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoiceSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choice_sentences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subject_id')->nullable()->default(99);         // 科目名ID
            $table->integer('title_id')->nullable();                        // 問題タイトルID
            $table->integer('question_number');                             // 問題番号
            $table->integer('choice_id');                                   // 選択肢ID
            $table->string('choice_sentence');                              // 選択肢文
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
        Schema::dropIfExists('choice_sentences');
    }
}
