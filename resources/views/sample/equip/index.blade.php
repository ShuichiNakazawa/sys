<!-- resources/views/equip/index.blade.php -->
@extends('layouts.app_equip')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')
        <br>

        <div style="margin:0 auto; width: 50%">
          <h2 class="txt_center">備品管理システム メニュー</h2>
          <br><br>

          <a href="{{ route('sample.equip.refer_equip') }}">
            <button>備品参照</button>
          </a>
          <br><br>

          <a href="{{ route('sample.equip.inout_management') }}">
            <button>入出庫管理</button>
          </a>
          <br><br><br>

          {{-- マスタ管理権限が必要 --}}
          <a href="{{ route('sample.equip.register_m_dept') }}">
            <button>部門マスタ登録</button>
          </a>
          <br><br>

          {{-- 備品マスタ登録 --}}
          <a href="{{ route('sample.equip.register_m_equip') }}">
            <button>備品マスタ登録</button>
          </a>
          <br><br>

          {{-- 権限を持ったユーザのみに表示 --}}
          <a href="{{ route('sample.equip.register_account') }}">
            <button>新規アカウント登録</button>
          </a> ※管理者権限のみ表示
          <br><br>

          {{-- 権限を持ったユーザのみに表示 --}}
          <a href="{{ route('sample.equip.register_privileges') }}">
            <button>権限マスタ登録</button>
          </a> ※管理者権限のみ表示
          <br><br>

          {{-- 権限を持ったユーザのみに表示 --}}
          <a href="{{ route('sample.equip.edit_privileges') }}">
            <button>ユーザ権限編集</button>
          </a> ※管理者権限のみ表示
          <br><br>

          <br><br>

        </div>
        <br><br><br>
        @endsection

        @section('footer')

        @endsection
    </body>
</html>