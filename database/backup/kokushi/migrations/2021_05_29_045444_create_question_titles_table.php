<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_titles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subject_name_id');
            $table->integer('title_id')->nullable()->default('0');
            $table->string('question_title');
            $table->string('sight_key', 20);
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
        Schema::dropIfExists('question_titles');
    }
}
