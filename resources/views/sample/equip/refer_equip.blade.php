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
          <br><br>

          {{--
          <table class="equipment_table">
            --}}
          <table class="table table-striped equipment_table">
            <tr>
              <th>
                ID
              </th>
              <th>
                所属部門
              </th>
              <th>
                備品名称
              </th>
              <th>
                在庫数
              </th>
              <th>
                画像ファイル
              </th>
              <th>
                アラート閾値
              </th>
              <th>
                前回アラート通知日時
              </th>
              <th>
                タグ1
              </th>
              <th>
                タグ2
              </th>
              <th>
                タグ3
              </th>
              <th colspan="2">
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
                  ※備品在庫テーブルから取得
                </td>
                <td>
                  {{ $equipment->image_name }}
                </td>
                <td>
                  {{ $equipment->notification_min_value }}
                </td>
                <td>
                  {{ $equipment->id }}datetime_alert
                </td>

                <td>
                  ※備品タグテーブルから取得
                </td>
                <td>
                  ※備品タグテーブルから取得
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
