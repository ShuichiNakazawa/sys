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
          @if(Auth::user()->privilege_access < 3)
            <a href="{{ route('sample.equip.register_m_dept') }}">
              <button>部門マスタ登録</button>
            </a>
            <br><br>
          @endif

          @if(Auth::user()->privilege_access < 3)
            {{-- 備品マスタ登録 --}}
            <a href="{{ route('sample.equip.register_m_equip') }}">
              <button>備品マスタ登録</button>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            {{-- 備品マスタ編集 --}}
            <a href="{{ route('sample.equip.edit_m_equip') }}">
              <button>備品マスタ編集</button>
            </a>
            <br><br>
          @endif

          {{-- 権限を持ったユーザのみに表示 --}}
          @if(Auth::user()->privilege_access < 3)
            <a href="{{ route('sample.equip.register_account') }}">
              <button>新規アカウント登録</button>
            </a>
            <br><br>
          @endif


          {{-- 権限を持ったユーザのみに表示 --}}
          @if(Auth::user()->privilege_access < 3)
            <a href="{{ route('sample.equip.refer_user') }}">
              <button>ユーザー情報参照</button>
            </a>
            <br><br>
          @endif

          <br><br>

        </div>

        <div style="margin:0 auto; width: 50%" class="memo_outer">
          <h4>
            作成中メモ
          </h4>
          ◆◆◆備品マスタにて、画像登録の実装
          <br><br>

          ◆◆備品検索機能の実装
          <br><br>

          ユーザ情報の編集機能の実装
          <br><br>

          入出庫管理、編集機能の実装
          <br><br>

        </div>
        <br><br><br>
        @endsection

        @section('footer')

        @endsection
    </body>
</html>
