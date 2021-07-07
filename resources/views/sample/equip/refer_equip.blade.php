<!-- resources/views/equip/refer_equip.blade.php -->
@extends('layouts.app_equip')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')
        <div style="margin:0 auto; width: 80%">
          <div>
            <a href="{{ route('sample.equip.index') }}">
              <button>メニューへ戻る</button>
            </a>
          </div>

          <h2 class="txt_center">備品参照</h2>
          <br>

          <form action="#">
            検索対象：
            <input type="radio" name="search_at" id="search_at_1" value="1" checked="checked"><label for="search_at_1">備品名</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" name="search_at" id="search_at_2" value="2"><label for="search_at_2">タグ</label>&nbsp;&nbsp;&nbsp;

            @if( Auth::user()->privilege_access == 1)
              <input type="radio" name="search_at" id="search_at_3" value="3"><label for="search_at_3">部門</label>&nbsp;&nbsp;&nbsp;
            @endif

            <input type="text" name="serch_key"><input type="submit" value="検索">
          </form>
          <br><br>

          <table class="table table-striped equipment_table">
            <tr>
              <th class="txt_center">
                ID
              </th>
              <th class="txt_center">
                部門
              </th>
              <th class="txt_center">
                備品名
              </th>
              <th class="txt_center">
                画像ファイル
              </th>
              <th class="txt_center">
                在庫数
              </th>

              <th class="txt_center">
                アラート閾値
              </th>
              <th class="txt_center">
                アラート<br>通知日時
              </th>
              <th class="txt_center">
                設定タグ
              </th>
              <th colspan="2" class="txt_center">
                変更
              </th>
            </tr>

            {{-- 以降、DBから取得 --}}
            @foreach( $equipments as $equipment )
              <tr>
                <td>
                  {{ $equipment->id }}
                </td>
                <td>
                  {{ $equipment->M_dept->name_of_dept }}
                </td>
                <td>
                  {{ $equipment->name_of_equipment }}
                </td>
                <td>
                  <img src="" alt="備品画像({{ $equipment->name_of_equipment }})">
                  <br>
                  {{ $equipment->image_name }}
                </td>
                <td>
                  ※備品在庫テーブルから取得
                </td>

                <td class="txt_center">
                  {{ $equipment->notification_min_value }}個
                </td>
                <td>
                  {{ date_create($equipment->datetime_alert)->format('n月j日 G時') }}
                </td>

                <td>
                  ※備品タグテーブルから取得
                </td>
                <td>
                  <button>修正</button>
                </td>
                <td>
                  <button>削除</button>
                </td>
              </tr>
            @endforeach
                
{{--
            <tr>
              <td>
                1
              </td>
              <td>
                資材調達部
              </td>
              <td>
                ドライバー
              </td>
              <td>
                51
              </td>
              <td>
                driver.jpg
              </td>
              <td>
                10
              </td>
              <td>
                2021年6月26日
              </td>

              <td>
                工具
              </td>
              <td>
                常用
              </td>
              <td>
                損耗低
              </td>
              <td>
                <button>修正</button>
              </td>
              <td>
                <button>削除</button>
              </td>
            </tr>

            <tr>
              <td>
                1
              </td>
              <td>
                資材調達部
              </td>
              <td>
                ハンマー
              </td>
              <td>
                61
              </td>
              <td>
                hammer.jpg
              </td>
              <td>
                15
              </td>
              <td>
                2021年6月26日
              </td>
              <td>
                工具
              </td>
              <td>
                常用
              </td>
              <td>
                損耗低
              </td>
              <td>
                <button>修正</button>
              </td>
              <td>
                <button>削除</button>
              </td>
            </tr>

            <tr>
              <td>
                3
              </td>
              <td>
                資材調達部
              </td>
              <td>
                パイプレンチ
              </td>
              <td>
                30
              </td>
              <td>
                pipe_wrench.jpg
              </td>
              <td>
                10
              </td>
              <td>
                2021年6月26日
              </td>
              <td>
                工具
              </td>
              <td>
                利用率低
              </td>
              <td>
                損耗低
              </td>
              <td>
                <button>修正</button>
              </td>
              <td>
                <button>削除</button>
              </td>
            </tr>

            <tr>
              <td>
                4
              </td>
              <td>
                資材調達部
              </td>
              <td>
                シールテープ
              </td>
              <td>
                121
              </td>
              <td>
                sealing_tape.jpg
              </td>
              <td>
                30
              </td>
              <td>
                2021年6月26日
              </td>
              <td>
                補修材
              </td>
              <td>
                常用
              </td>
              <td>
                損耗低
              </td>
              <td>
                <button>修正</button>
              </td>
              <td>
                <button>削除</button>
              </td>
            </tr>

            <tr>
              <td>
                5
              </td>
              <td>
                資材調達部
              </td>
              <td>
                グラインダー
              </td>
              <td>
                31
              </td>
              <td>
                grinder.jpg
              </td>
              <td>
                10
              </td>
              <td>
                2021年6月26日
              </td>
              <td>
                工具
              </td>
              <td>
                常用
              </td>
              <td>
                損耗低
              </td>

              <td>
                <button>修正</button>
              </td>
              <td>
                <button>削除</button>
              </td>
            </tr>


            <tr>
              <td>
                5
              </td>
              <td>
                資材調達部
              </td>
              <td>
                グラインダー 替え刃
              </td>
              <td>
                87
              </td>
              <td>
                grinder_blade.jpg
              </td>
              <td>
                10
              </td>
              <td>
                2021年6月26日
              </td>
              <td>
                工具
              </td>
              <td>
                常用
              </td>
              <td>
                損耗高
              </td>

              <td>
                <button>修正</button>
              </td>
              <td>
                <button>削除</button>
              </td>
            </tr>
--}}

          </table>


          <br><br>

        </div>
        <br><br><br>
        @endsection

        @section('footer')

        @endsection
    </body>
</html>
