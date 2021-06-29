<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookOneweeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_oneweeks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("inout"); # 収入：１、支出：２
            $table->string("category"); # カテゴリー、給料や光熱費など
            $table->integer("year"); # 年度
            $table->integer("month"); # 月
            $table->integer("amount"); # 金額
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
        Schema::dropIfExists('book_oneweeks');
    }
}
