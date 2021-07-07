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

          <table class="table_equip table-striped equipment_table">
          {{--
          <table class="table table-striped equipment_table">
            --}}
            <tr></tr>
            <tr>
              <th></th><th></th><th></th><th></th><th></th><th></th><th colspan="2"><button>ボタン入力</button></th><th class="button_row"></th><th></th>
            </tr>
            
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
                在庫<br>（現在）
              </th>
              <th class="txt_center">
                在庫<br>（変更後）
              </th>

              <th class="txt_center">
                入庫
              </th>
              <th class="txt_center">
                出庫
              </th>
              <th class="txt_center button_row">
                在庫変動
              </th>
              <th class="txt_center">
                データ更新
              </th>
            </tr>

            {{-- 以降、DBから取得 --}}
            @foreach( $equipments as $equipment )
              <form action="#">
              @csrf
              <tr>
                <td class="txt_center vertical_middle">
                  {{ $equipment->id }}
                </td>
                <td class="vertical_middle">
                  {{ $equipment->M_dept->name_of_dept }}
                </td>
                <td class="vertical_middle">
                  {{ $equipment->name_of_equipment }}
                </td>
                <td class="vertical_middle">
                  <img src="" alt="備品画像({{ $equipment->name_of_equipment }})">
                  <br>
                  {{ $equipment->image_name }}
                </td>
                <td class="txt_center vertical_middle">
                  {{ $equipment->t_equip_stock->stock_quantity }}
                </td>
                <td class="txt_center vertical_middle">
                  {{ $equipment->t_equip_stock->stock_quantity }}
                </td>

                <td class="txt_center vertical_middle">
                  <input type="text" maxlength="4" size="2">
                </td>
                <td class="txt_center vertical_middle">
                  <input type="text" maxlength="4" size="2">
                </td>
                <td class="button_row">
                  <button>+100</button>&nbsp;&nbsp;&nbsp;<button>-100</button>
                  <br><br>

                  <button>+10</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button>-10</button>
                  <br><br>

                  <button>+1</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button>-1</button>
                  <br><br>
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
