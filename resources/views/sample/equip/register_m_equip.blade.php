<!-- resources/views/equip/register_m_equip.blade.php -->
@extends('layouts.app_equip')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')
        <div style="margin:0 auto; width: 90%">
          <div>
            <a href="{{ route('sample.equip.index') }}">
              <button>メニューへ戻る</button>
            </a>
          </div>

          <h2 class="txt_center">備品マスタ登録</h2>
          <br><br>

          <form action="{{ action('EquipController@registerM_equip') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="equip_outer">
              <div class="display_flex">
                <div class="txt_center equip_item">
                  <img id="preview" style="width: 200px; height:200px;" alt="備品画像">
                  <br><br>

                  <input type="file" name="upfile">
                </div>

                <div class="equip_item">

                </div>
              </div>

              <div class="row">
                <div class="equip_item">
                  備品名：　　　<input type="text" name="name_of_equip">
                  <br><br>

                  所属部門：　　
                  <select name="dept_id">
                    {{-- 部門テーブルより取得 --}}
                    @foreach( $depts as $dept )
                      <option value="{{ $dept->id }}">
                        {{ $dept->name_of_dept }}
                      </option>
                    @endforeach
                  </select>
                  <br><br>

                  アラート閾値：
                  <input type="number" name="notification_min_value">
                  <br><br>

                  <div>
                    タグ：　　　　
                    <input type="text" name="tag1">
                    <a href="javascript:addTag();" class="btn btn-secondary btn-light">追加</a>
                  </div>
  
                  
                  <br><br>
  
                  <button>登録</button>
                </div>
              </div>
              <div class="equip_item">
                【設定タグ】

              </div>

            </div>


          </form>
          <br><br>

          <table class="table table-striped equipment_table">

            <tr>
              <th class="text-center">
                ID
              </th>
              <th class="text-center">
                部門
              </th>
              <th class="text-center">
                備品名称
              </th>
              <th class="text-center">
                画像ファイル
              </th>
              <th class="text-center">
                アラート閾値
              </th>
              <th class="text-center">
                前回アラート<br>通知日時
              </th>
              <th class="text-center">
                タグ1
              </th>
              <th class="text-center">
                タグ2
              </th>
              <th class="text-center">
                タグ3
              </th>
              <th colspan="2" class="text-center">
                変更
              </th>
            </tr>

            {{-- 以降、DBから取得 --}}
            @foreach( $equipments as $equip )

              <tr>
                <td>
                  {{ $equip->id }}
                </td>
                
                <td>
                  {{ $equip->m_dept->name_of_dept }}
                  {{-- M_equipment --}}
                </td>
                <td>
                  {{ $equip->name_of_equipment }}
                </td>
                <td>
                  {{ $equip->image_name }}
                </td>
                <td>
                  {{ $equip->notification_min_value }}
                </td>
                <td>
                  {{ $equip->datetime_alert }}
                </td>

                @php
                  $index = 0;
                @endphp

                @foreach($equip->t_equipment_tags as $tag)
                  <td>
                    {{ $tag->name_of_tag }}
                  </td>
                  @php
                    $index++;
                  @endphp
                @endforeach

                @switch($index)
                  @case(0)
                    <td></td><td></td><td></td>
                    @break
                  @case(1)
                    <td></td><td></td>
                    @break
                  @case(2)
                    <td></td>
                    @break
                @endswitch


                <td>
                  <button>修正</button>
                </td>
                <td>
                  <button>削除</button>
                </td>
              </tr>
            @endforeach


          </table>


          <br><br>

        </div>
        <br><br><br>
        @endsection

        @section('footer')

        @endsection

        @section('script')
        {{--
          <script type="module">
            $('#filename').on("change", function() {

              console.log('発火確認');
              var file = this.files[0];
              if(file != null) {
                document.getElementById("dummy_file").value = file.name;
              }

              //const file = event.target.files[0],
              reader = new FileReader(),
              $preview = $('#image_equip'); // 表示する所

              // 画像ファイル以外は処理停止
              if(file.type.indexOf("image") < 0){
                return false;
              }

              // ファイル読み込みが完了した際に発火するイベントを登録
              reader.onload = function() {
                  // .prevewの領域の中にロードした画像を表示
                  $preview.attr('src',event.target.result);
              };

              reader.readAsDataURL(file);
            });
          </script>
          --}}
    </body>
</html>
