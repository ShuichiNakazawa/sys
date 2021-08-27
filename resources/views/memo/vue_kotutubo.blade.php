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
	  <h2 style="text-align:center;">Vue.js 基本</h2>
		<div class="text_outer">
			<div id = "main">
	
				<h4>Vueのコンポーネントが持てる主なプロパティ</h4>
				<table style="border-collapse: collapse; border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color: aquamarine;" class="txt_center">プロパティ</th>
						<th style = "background-color: #000077; color: #fff; text-align: center;">役割</th>
					</tr>
					<tr>
						<td>el</td>
						<td>コンポーネントのインスタンスをどのHTML要素に結びつけるかを定義する</td>
					</tr>
					<tr>
						<td>data</td>
						<td>コンポーネントが保持する<span style="color: red;"><b>データ</b></span>を定義する</td>
					</tr>
					<tr>
						<td>methods</td>
						<td>コンポーネントが持つ<span style="color: red;"><b>メソッド</b></span>を定義する</td>
					</tr>
	
					<tr>
						<td>filters</td>
						<td>コンポーネントが持つ<span style="color: red;"><b>フィルター</b></span>を定義する</td>
					</tr>

                    <tr>
						<td>computed</td>
						<td>コンポーネントが持つ<span style="color: red;"><b>算出プロパティ</b></span>を定義する</td>
					</tr>

                    <tr>
						<td>watch</td>
						<td>コンポーネントが持つ<span style="color: red;"><b>ウォッチャ</b></span>を定義する</td>
					</tr>

                    <tr>
						<td>（ライフサイクルハック）</td>
						<td>コンポーネントが持つ<span style="color: red;"><b>ライフサイクルハック</b></span>を定義する</td>
					</tr>

				</table>
				<br><br>


                <h4>コンポーネントのライフサイクルハック</h4>
				<table style="border-collapse: collapse; border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color: aquamarine;" class="txt_center">ハック名</th>
						<th style = "background-color: #000077; color: #fff; text-align: center;">発生するタイミング</th>
					</tr>
					<tr>
						<td>beforeCreate</td>
						<td>コンポーネントのインスタンスが生成された直後</td>
					</tr>
					<tr>
						<td>created</td>
						<td>コンポーネントのインスタンスが生成され、Vueがコンポーネントのリアクティブデータを監視する準備が終わったとき</td>
					</tr>
					<tr>
						<td>beforeMount</td>
						<td>コンポーネントのインスタンスがDOMと結びつく直前</td>
					</tr>
					<tr>
						<td>mounted</td>
						<td>コンポーネントのインスタンスがDOMと結びついた直後</td>
					</tr>
					<tr>
						<td>beforeUpdate</td>
						<td>コンポーネントが持つリアクティブデータが更新され、DOMに反映される直前</td>
					</tr>
                    <tr>
						<td>updated</td>
						<td>コンポーネントが持つリアクティブデータが更新され、DOMに反映された直後</td>
					</tr>
                    <tr>
						<td>beforeDestroy</td>
						<td>コンポーネントのインスタンスが破棄される直前</td>
					</tr>
                    <tr>
						<td>destroyed</td>
						<td>コンポーネントのインスタンスが破棄された直後</td>
					</tr>
				</table>
				<br><br>


				<h4>レンダリング</h4>
				<table style="border-collapse: collapse; border:solid 1px #888;" class="table">
					<tr>
						<th style="background-color: aquamarine; width: 250px;" class="txt_center">目的</th>
						<th style = "background-color: #000077; color: #fff; text-align: center;">書式</th>
                        <th style="text-align: center; background: lightyellow; width: 400px;">具体例</th>
                    </tr>

					<tr>
						<td>テキストにバインドする</td>
						<td>@{{ プロパティ名 }}</td>
                        <td>
                            【HTML】<br>
                            &lt;div id="app"&gt;<br>
                            &nbsp;&nbsp;@{{message}}<br>
                            &lt;/div&gt;<br>
                            <br>
                            【JavaScript】<br>
                            var app = new Vue({<br>
                                &nbsp;&nbsp;el: '#app',<br>
                                &nbsp;&nbsp;data: {<br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;message: 'こんにちは！'
                                }<br>
                            });<br>
                        </td>
					</tr>
                    <tr>

                    </tr>

					<tr>
						<td>属性にバインドする</td>
						<td>&lt;要素名 v-bind:属性名="プロパティ名"&gt;</td>
                        <td>
                            【HTML】<br>
                            &lt;div id="app"&gt;<br>
                            &nbsp;&nbsp;&lt;input type="text" v-bind:value="message"&gt;<br>
                            &lt;div&gt;<br>
                            <br>
                            【JavaScript】<br>
                            var app = new Vue({<br>
                                &nbsp;&nbsp;el: '#app',<br>
                                &nbsp;&nbsp;data: {<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;message 'こんにちは！'<br>
                                &nbsp;&nbsp;}<br>
                            });
                        </td>
					</tr>
					<tr>
						<td>
                            スタイル属性にバインドする<br>
                            <span style="color:red;">※CSSのプロパティ名はキャメルケースに変更する</span>
                        </td>
						<td>
                            &lt;要素名 v-bind:style="{CSSのプロパティ名: アプリケーションのプロパティ名}"&gt;
                        </td>
                        <td>
                            【HTML】<br>
                            &lt;div id="app"&gt;<br>
                            &nbsp;&nbsp;&lt;p v-bind:style=&quot;@{{fontSize:pSize}}&quot;&gt;<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;文字サイズは@{{pSize}}です。<br>
                            &nbsp;&nbsp;&lt;/p&gt;<br>
                            &lt;/div&gt;<br>
                            <br>
                            【JavaScript】<br>
                            var app = new Vue({<br>
                                &nbsp;&nbsp;el: '#app',<br>
                                &nbsp;&nbsp;data: {<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;pSize: '40px'<br>
                                &nbsp;&nbsp;}<br>
                        </td>
					</tr>
					<tr>
						<td>クラス属性にバインドする</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
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
