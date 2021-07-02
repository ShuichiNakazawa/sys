<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');                                // ID
            $table->string('name');                                     // 氏名
            $table->string('password');                                 // パスワード
            $table->rememberToken();                                    // トークン
            $table->string('email')->unique();                          // Eメールアドレス
            $table->timestamp('email_verified_at')->nullable();         // Eメール認証日時

            $table->string('sight_key')->nullable();                    // サイトキー
            $table->string('account_id')->nullable();                   // アカウントID
            $table->integer('privilege_access')->nullable();            // 利用可能システムコード(アクセス権限)
            $table->integer('dept_id')->nullable();                     // 部門ID

            $table->integer('age')->nullable();                         // 年齢
            $table->string('street_address')->nullable();               // 住所
            $table->string('profession')->nullable();                   // 職業

            $table->integer('ticket1hour')->default(0);                 // ５５分チケット
            $table->integer('ticket15min')->default(0);                 // １５分チケット
            $table->integer('ticket15min_trial')->default(2);           // １５分お試しチケット
            $table->string('ip_address')->nullable();                   // ＩＰアドレス
            $table->string('user_agent', 300)->nullable();              // ユーザーエージェント
            $table->timestamps();                                       // タイムスタンプ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
