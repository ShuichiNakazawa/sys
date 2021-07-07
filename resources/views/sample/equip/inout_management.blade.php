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

          <h2 class="txt_center">備品入出庫管理</h2>
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
                画像
              </th>
              <th class="txt_center">
                在庫数
              </th>
              <th class="txt_center">
                入庫
              </th>
              <th class="txt_center">
                出庫
              </th>
              <th class="txt_center">
                データ更新
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
                  <input type="text" maxlength="4" size="2">
                </td>
                <td class="txt_center">
                  <input type="text" maxlength="4" size="2">
                </td>
                <td class="txt_center">
                  <input type="submit" value="更新">
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
    </body>
</html>
