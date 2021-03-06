<!-- resources/views/equip/register_m_dept.blade.php -->
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

          <h2 class="txt_center">部門マスタ登録</h2>
          <br><br>

          <form action="{{ action('EquipController@registerDept') }}" method="post">
            @csrf
            部門名：<input type="text" name="name_of_dept">
            <button>登録</button>
          </form>
          <br><br>

          <h4>部門リスト<h4>
          <table class="table table-striped equipment_table">

            <tr>
              <th class="text-center">
                ID
              </th>
              <th class="text-center">
                部門名称
              </th>
              <th class="text-center">
                登録者
              </th>
              <th class="text-center">
                最終更新日
              </th>
              <th colspan="2" class="text-center">
                変更
              </th>

            </tr>

            {{-- 以降、DBから取得 --}}
            @foreach( $depts as $dept )
              <tr>
                <td>
                  {{ $dept->id }}
                </td>
                <td>
                  {{ $dept->name_of_dept }}
                </td>
                <td>
                  {{ $dept->editor }}
                </td>
                <td>
                  {{ $dept->updated_at }}
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
                営業部
              </td>
              <td>
                ユーザー１
              </td>
              <td>
                2021年5月14日
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
                2
              </td>
              <td>
                資材調達部
              </td>
              <td>
                ユーザー１
              </td>
              <td>
                2021年5月14日
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
                現場監督部
              </td>
              <td>
                ユーザー１
              </td>
              <td>
                2021年5月14日
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
                建築部
              </td>
              <td>
                ユーザー１
              </td>
              <td>
                2021年5月14日
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
                土木部
              </td>
              <td>
                ユーザー１
              </td>
              <td>
                2021年5月14日
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
