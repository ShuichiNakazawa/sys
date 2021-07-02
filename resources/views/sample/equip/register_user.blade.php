<!-- resources/views/equip/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')
        <br>

        <div style="margin:0 auto; width: 80%">
          <h2 class="txt_center">新規アカウント登録</h2>
          <br><br>

          <form action="{{ action('EquipController@registerUser') }}" method="post">
            @csrf

            アカウントID：
            <input type="text" name="account_ID">
            <br><br>

            氏名：
            <input type="text" name="user_name">
            <br><br>

            所属部門：
            @if(Auth::user()->privilege_access == 1)
              <select name="dept_id">
                {{-- 部門テーブルより取得 --}}
                @foreach( $depts as $dept )
                  <option value="{{ $dept->id }}">
                    {{ $dept->name_of_dept }}
                  </option>
                @endforeach
              </select>
              <br><br>

              権限：
              <select name="privilege">
                <option value="1">総合管理者</option>
                <option value="2">部門管理者</option>
                <option value="3">一般ユーザ</option>
              </select>

            @elseif(Auth::user()->privilege_access == 2)
              <input type="text" name="dept_id" value="{{ Auth::user()->dept_id }}" disabled="disabled">※部門マスタから値を元に取得
              <br><br>

              権限：
              <select name="privilege">
                <option value="0">一般</option>
                <option value="1">部門管理者</option>
              </select>
            @endif
           
            <button>登録</button>
          </form>
          <br><br>

          <h4>ユーザーリスト<h4>
          <table class="table table-striped equipment_table">

            <tr>
              <th class="text-center">
                ID
              </th>
              <th class="text-center">
                ユーザ名
              </th>
              <th class="text-center">
                アカウントID
              </th>
              <th class="text-center">
                所属部門
              </th>

              <th>
                権限
              </th>

              <th class="text-center">
                最終更新日
              </th>
              <th colspan="2" class="text-center">
                変更
              </th>

            </tr>

            {{-- 以降、DBから取得 --}}
            @if(!empty($users))
              @foreach( $users as $user )
                <tr>
                  <td>
                    {{ $user->id }}
                  </td>
                  <td>
                    {{-- ユーザ名をuserテーブルで見て記入 --}}
                    {{ $user->name }}
                  </td>
                  <td>
                    {{ $user->account_id }}
                  </td>
                  <td>
                    {{ $user->dept_id }}
                  </td>

                  <td>
                    {{ $user->privilege }}
                  </td>

                  <td>
                    {{ $user->updated_at }}
                  </td>

                  <td>
                    <button>修正</button>
                  </td>
                  <td>
                    <button>削除</button>
                  </td>
                </tr>  
              @endforeach
            @endif
          </table>

          <br><br>

        </div>
        <br><br><br>
        @endsection

        @section('footer')

        @endsection
    </body>
</html>
