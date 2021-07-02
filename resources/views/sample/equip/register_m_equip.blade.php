<!-- resources/views/equip/register_m_equip.blade.php -->
@extends('layouts.app_equip')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')
        <br>

        <div style="margin:0 auto; width: 90%">
          <h2 class="txt_center">備品マスタ登録</h2>
          <br><br>

          <form action="{{ action('EquipController@registerM_equip') }}" method="post">
            @csrf
            備品名：<input type="text" name="name_of_equip">
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

            画像：
            <input type="file" name="image">
            <br><br>

            アラート閾値：
            <input type="number" name="notification_min_value">
            <br><br>

            タグ：
            <input type="text" name="tag1">
            <br><br>

            <a href="javascript:addTag();" class="btn btn-secondary btn-light">タグを追加</a>
            <br><br>

            <button>登録</button>
          </form>
          <br><br>

          <table class="table table-striped equipment_table">

            <tr>
              <th class="text-center">
                ID
              </th>
              <th class="text-center">
                所属部門
              </th>
              <th class="text-center">
                備品名称
              </th>
              <th class="text-center">
                在庫数
              </th>
              <th class="text-center">
                画像ファイル
              </th>
              <th class="text-center">
                アラート閾値
              </th>
              <th class="text-center">
                前回アラート通知日時
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
                  {{ $equip->dept_id }}
                </td>
                <td>
                  {{ $equip->name_of_equip }}
                </td>
                <td>
                  備品在庫管理テーブルから取得
                </td>
                <td>
                  {{ $equip->image_name }}
                </td>
                <td>
                  10
                </td>
                <td>
                  {{ $equip->datetime_alirt }}
                </td>

                <td>
                  備品タグテーブルから取得
                </td>
                <td>
                  備品タグテーブルから取得
                </td>
                <td>
                  備品タグテーブルから取得
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
