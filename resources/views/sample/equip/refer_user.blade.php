<!-- resources/views/equip/register_user.blade.php -->
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

          <h2 class="txt_center">ユーザー情報参照</h2>
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
                    {{ $user->login_id }}
                  </td>
                  <td>
                    {{ $user->M_dept->name_of_dept }}
                  </td>

                  <td>
                    @switch($user->privilege_access)
                      @case(1)
                        総合管理者
                        @break

                      @case(2)
                        部門管理者
                        @break
                      @case(3)
                        一般
                        @break
                    @endswitch

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
