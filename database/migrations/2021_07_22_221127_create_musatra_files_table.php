<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusatraFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musatra_files', function (Blueprint $table) {
            $table->bigIncrements('id');        // ID
            $table->integer('comment_id');      // コメントID
            $table->integer('file_id');         // ファイルID
            $table->string('file_name');        // ファイル名
            $table->timestamps();               // タイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('musatra_files');
    }
}
