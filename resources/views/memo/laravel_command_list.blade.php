<!-- resources/views/sys/memo.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
	
@include('common.errors')
	  <br>

	<div style="margin:0 auto; width: 60%;">
	  <h2 style="text-align:center;">Laravel コマンド一覧</h2>
		<div class="text_outer">
			<div id = "main">
	
				<h4>Laravel 基本コマンド</h4>
				<table style="border-collapse: collapse; border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color: aquamarine;" class="txt_center">目的</th>
						<th style = "background-color: #000077; color: #fff; text-align: center;">コマンド</th>
					</tr>
					<tr>
						<td>プロジェクト作成(バージョン指定)</td>
						<td>composer create-project laravel/laravel 〇〇 6.* --prefer-dist</td>
					</tr>
					<tr>
						<td>開発サーバ 起動</td>
						<td>php artisan serve --port=〇〇</td>
					</tr>
					<tr>
						<td>開発サーバ ホスト指定起動（例）自ホスト、ポート８０番</td>
						<td>php artisan serve --host=0.0.0.0 --port=80</td>
					</tr>
	
					<tr>
						<td>シーダ―でメモリ不足になった場合</td>
						<td>php -d memory_limit=512M /usr/local/bin/composer require hoge</td>
					</tr>
				</table>
				<br><br>
	
				<table style="border-collapse: collapse; border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color: aquamarine;" class="txt_center">目的</th>
						<th style = "background-color: #000077; color: #fff; text-align: center;">コマンド</th>
					</tr>
					<tr>
						<td>マイグレーションファイル 作成</td>
						<td>php artisan make:migration create_テーブル名_table --create=comments</td>
					</tr>
					<tr>
						<td>シーダファイル 作成</td>
						<td>php artisan make:seeder テーブル名（先頭大文字）TableSeeder</td>
					</tr>
					<tr>
						<td>モデル作成</td>
						<td>php artisan make:model モデル名（先頭大文字）</td>
					</tr>
					<tr>
						<td>コントローラ 作成</td>
						<td>php artisan make:controller テーブル名（先頭大文字）Controller</td>
					</tr>
					<tr>
						<td>ルート定義の確認</td>
						<td>php artisan route:list</td>
					</tr>
				</table>
				<br><br>

				<h4>ディレクトリ構成一覧</h4>
				<table style="border-collapse: collapse; border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color: aquamarine; width: 110px;" class="txt_center">フォルダ名</th>
						<th style = "background-color: #000077; color: #fff; text-align: center;">説明</th>
					</tr>
					<tr>
						<td>app</td>
						<td>アプリケーションのコアコードを配置する。コントローラ・モデルも基本的にこのフォルダに配置する。</td>
					</tr>
					<tr>
						<td>bootstrap</td>
						<td>フレームワークの初期起動やオートローディングの設定を行う起動コードファイルを含んている。その中のcacheディレクトリは初期処理のパフォーマンスを最適化するため、フレームワークが生成するいくつかのファイルが保存されるフォルダ</td>
					</tr>
					<tr>
						<td>config</td>
						<td>アプリケーションの全設定ファイルが配置されている</td>
					</tr>
					<tr>
						<td>database</td>
						<td>データベースのマイグレーションと初期値設定（シーディング）を配置する。また、このファイルをSQLiteデータベースの設置場所としても利用できる。</td>
					</tr>
					<tr>
						<td>public</td>
						<td>フロントコントローラとアセット（画像、JavaScript、CSSなど）を配置する。DocumentRootになるディレクトリ。URLから直接アクセスできるフォルダ。</td>
					</tr>
					<tr>
						<td>resources</td>
						<td>ビューやアセットの元ファイル（LESS、SASS、CoffeeScript）、言語ファイルを配置する。</td>
					</tr>
					<tr>
						<td>routes</td>
						<td>ルート定義を行うファイルを置く。Web.phpとapi.phpがありapi.phpはAPIを利用する場合との使い分けとなる。</td>
					</tr>
					<tr>
						<td>storage</td>
						<td>app、framework、logsディレクトリの３つのフォルダがある。appディレクトリはアプリケーションにより使用されるファイルを保存するために利用する。frameworkディレクトリはフレームワークが生成するファイルやキャッシュに利用される。最後のlogsディレクトリはアプリケーションのログファイルが保存される。</td>
					</tr>
					<tr>
						<td>tests</td>
						<td>自動テストを配置する。サンプルのPHPUnitテスト（PHP単体で出釣ソするツール）が最初に含まれている。</td>
					</tr>
					<tr>
						<td>vendor</td>
						<td>Composerでインストールしたパッケージが配置される。基本的にはこのパッケージを直接触ることはない。</td>
					</tr>
				</table>
				<br><br>
	
				<h4>最初に覚えておくこと</h4>
				<ul>
					<li>/.env（環境設定/DB設定）</li>
					<li>/config/app.php（アプリケーション基本設定）</li>
					<li>/routes/web.php（ルート定義）</li>
					<li>/resources/views/以下（ビュー・HTMLなどの表示要素を設定）</li>
					<li>/app/Http/Controllers/以下（コントロール／モデルを設定）</li>
				</ul>
				<br><br>
	
				<h4>カラム型の一覧</h4>
				<table style="border-collapse:collapse;border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color:aquamarine" class="txt_center">カラム型</th>
						<th style="background-color: #000077;color:white;" class="txt_center">説明</th>
					</tr>
					<tr>
						<td>$table->increments['???'];</td>
						<td>INTを使用したID自動採番（主キー）</td>
					</tr>
					<tr>
						<td>$table->bigIncrements['???'];</td>
						<td>BIGINT を使用したID自動採番（主キー）</td>
					</tr>
					<tr>
						<td>$table->id[];</td>
						<td>bigIncrements['id']のエイリアス<br>
						(Laravel7.x移行)</td>
					</tr>
					<tr>
						<td>$table->string['???'];</td>
						<td>VARCHAR カラム</td>
					</tr>
					<tr>
						<td>$table->string['???', 100];</td>
						<td>VARCHAR、長さ指定カラム</td>
					</tr>
					<tr>
						<td>table->integer['???'];</td>
						<td>INTEGER カラム</td>
					</tr>
					<tr>
						<td>$table->bigInteger['???'];</td>
						<td>BIG INTEGERカラム</td>
					</tr>
					<tr>
						<td>$table->decimal['???'];</td>
						<td>少数を扱うカラム</td>
					</tr>
					<tr>
						<td>$table->text['???'];</td>
						<td>TEXT カラム</td>
					</tr>
					<tr>
						<td>$table->datetie['???'};</td>
						<td>DATETIME カラム</td>
					</tr>
					<tr>
						<td>$table->timestamps[];</td>
						<td>created_at と updated_at カラムの追加</td>
					</tr>
					<tr>
						<td>$table->boolean['???'];</td>
						<td>true、flase カラム</td>
					</tr>
				</table>
				<br><br>

				<h4>migrate コマンド一覧</h4>
				<table class="table" style="border:solid 1px #888;">
					<tr>
						<th style="background-color:aquamarine;" class="txt_center">コマンド名</th>
						<th style="background-color: #000099; color:white;" class="txt_center">説明</th>
					</tr>
					<tr>
						<td>migrate</td>
						<td>マイグレーションファイルを実行する</td>
					</tr>
					<tr>
						<td>migrate:install</td>
						<td>migrations テーブルを作成する</td>
					</tr>
					<tr>
						<td>migrate:refresh</td>
						<td>マイグレーションを再実行してテーブルを再構築する。<br>
						テーブルとデータの初期化</td>
					</tr>
					<tr>
						<td>migrate:reset</td>
						<td>すべてのマイグレーション操作を元に戻す（全削除）</td>
					</tr>
					<tr>
						<td>migrate:rollback</td>
						<td>１つ前のマイグレーション操作した情報に戻す</td>
					</tr>
					<tr>
						<td>migrate:status</td>
						<td>マイグレーションファイルと実行状態を確認できる</td>
					</tr>
				</table>
				<br><br>
	
				<p>すべてのテーブルはマイグレーションを使用して定義変更する。<br>
				一度実行したマイグレーションファイルは「php artisan migrate」コマンドで再度実行しようとしても実行されない。<br>
				Laravelではmigrationsテーブルで実行した履歴を管理しているため、一度実行したマイグレーションファイルは実行しない仕組になっている。</p>
	
	
				<h4>カラム修飾子（一部）</h4>
				詳細は<a href="https://laravel.com/docs/">ここ</a>
				<ul>
					<li>$table->string('???')->nullable();  //カラムにNULLを許可する</li>
					<li>$table->string('???')->unique();  //指定したカラムの値を一意にする</li>
					<li>$table->string('???')->comment('???');  //コメントを追加する</li>
				</ul>
				<br><br><br>
	
				テーブルとモデルは、暗黙的に関連付けられる。<br>
				(例)テーブル名はnotes(末尾に「s」)、モデル名はNote(頭文字が大文字、sの無い単数形)<br><br>
	
				<h4>バリデーションルールの一覧</h4>
				<table style="border-collapse:collapse;border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color:aquamarine;" class="txt_center">ルール名</th>
						<th style="background-color:#000099;color:white;" class="txt_center">説明</th>
					</tr>
					<tr>
						<td>required</td>
						<td>入力値が空・NULLはNG</td>
					</tr>
					<tr>
						<td>string</td>
						<td>文字列はOK</td>
					</tr>
					<tr>
						<td>numeric</td>
						<td>数値はOK(小数はOK)</td>
					</tr>
					<tr>
						<td>integer</td>
						<td>整数値はOK（小数はNG）</td>
					</tr>
					<tr>
						<td>min</td>
						<td>入力値が指定された数値以上はOK</td>
					</tr>
					<tr>
						<td>max</td>
						<td>入力値が指定された数値以下はOK</td>
					</tr>
					<tr>
						<td>date</td>
						<td>年月日もしくは年月日時分秒はOK</td>
					</tr>
					<tr>
						<td>nullable</td>
						<td>NULLもOK</td>
					</tr>
					<tr>
						<td>unique</td>
						<td>入力値が指定されたテーブルに存在しなければOK</td>
					</tr>
					<tr>
						<td>email</td>
						<td>Emailアドレス（<a href="https://laravel.com/docs/6.x/validation#available">詳細</a>）</td>
					</tr>
				</table>
				<br><br>
	
				<h4>よく使うループ変数</h4>
				<table style="border-collapse:collapse;border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color:aquamarine" class="txt_center">プロパティ</th>
						<th style="background-color:#000099;color:white" class="txt_center">説明</th>
					</tr>
					<tr>
						<td>$loop->iteration</td>
						<td>この処理中の繰返している回数</td>
					</tr>
					<tr>
						<td>$loop->count</td>
						<td>このループが回る数</td>
					</tr>
					<tr>
						<td>$loop->first</td>
						<td>このループの最初</td>
					</tr>
					<tr>
						<td>$loop->last</td>
						<td>このループの最後</td>
					</tr>
					<tr>
						<td>$loop->even</td>
						<td>この処理が偶数回目か判定</td>
					</tr>
					<tr>
						<td>$loop->odd</td>
						<td>この処理が奇数回目か判定</td>
					</tr>
				</table>
				<br><br>
	
				<h4 style="width:500px;">ルーティング・コントローラ・ビューの流れ</h4>
				①ルーティング：/routes/web.php
				<div style="border:solid 1px;width:600px;">
					Route::get('/books, 'BooksController@index');
				</div>
				<p>
					↓
				</p>
				②コントローラ：/app/Http/Controllers/BooksController.php
				<div style="border:solid 1px;width:600px;">
					public function index(){<br>
					&nbsp;&nbsp;return view('books');<br>
					}
				</div>
				<p>
					↓
				</p>
				③ビュー：/resources/views/books.blade.php
				<div style="border:solid 1px;width:600px;">
					パーツ・テンプレート<br>
					
					&#064;extends('layouts.app')<br> 
					&#064;section('title')<br>
					トップリスト<br>
					&#064;endsection<br>

				</div>
				<p>
					↑
				</p>
				<div style="border:solid 1px;width:500px;">
					ベース・テンプレート
					<pre>
						<code>
	&lt;!DOCTYPE html&gt;
	&lt;html lang="ja"&gt;
	&lt;head&gt;
	&lt;meta charset="utf-8"&gt;
	&lt;title&gt;
	  &#064;yield('title')
	&lt;/title&gt;
						</code>
					</pre>
				</div>
				<br><br>
	
				<h4>SESSION ファサードの使用例</h4>
					<table style="border-collapse:collapse;border:solid 1px;">
					<tr>
						<th style="background-color:aquamarine;">SESSION ファサード</th>
						<th  style="background-color:#000099;color:white;">使用例</th>
					</tr>
					<tr>
						<td>SESSIONへデータ登録</td>
						<td>Session:put("message", "本登録が完了！");</td>
					</tr>
					<tr>
						<td>SESSIONからデータ取得</td>
						<td>Session::get("message");</td>
					</tr>
					<tr>
						<td>SESSION から１データ削除</td>
						<td>Session::forget("message");</td>
					</tr>
					<tr>
						<td>SESSION から全データ取得</td>
						<td>Session::all()</td>
					</tr>
					<tr>
						<td>SESSION から全データ削除</td>
						<td>Session::flush();</td>
					</tr>
					<tr>
						<td>SESSION に存在するかの確認</td>
						<td>Session::has("message");</td>
					</tr>
				</table>
				<br><br>
	
	
					<h4>blade内でパラメータをURLの一部として設定して渡す方法</h4>
					<table style="border-collapse:collapse;border:solid 1px;">
						<tr>
							<th style="background-color:aquamarine;">コード記述例</th>
						</tr>
					<tr>
						<td>
							<pre>
								<code>
     &lt;form action="&#123;&#123; url('book/' . $book->id . '/'
      . @{{ $book->name }}. '/' . $isbn) &#125;&#125;" method="POST"&gt;
        @csrf

        &lt;button&gt; type="submit" class="btn btn-primary"&gt;登録&lt;/button&gt;
	
        &lt;/form&gt;
								</code>
							</pre>
						</td>
					</tr>
				</table>
				<br><br>
			</div>

		</div>
	</div>
	<br><br><br>
	@endsection

  @section('footer')
  	<div class="container copyright">
      &copy;2020 - 2021 lara-assist.jp
    </div>
  @endsection
	</body>
</html>
