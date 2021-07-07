<!-- resources/views/equip/register_m_equip.blade.php -->
@extends('layouts.app_equip')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')
        <div style="margin:0 auto; width: 90%">
          <div>
            <a href="{{ route('sample.equip.index') }}">
              <button>メニューへ戻る</button>
            </a>
          </div>

          <h2 class="txt_center">備品マスタ編集</h2>
          <br><br>

          <table class="table table-striped equipment_table">

            <tr>
              <th class="text-center">
                ID
              </th>
              <th class="text-center">
                部門
              </th>
              <th class="text-center">
                備品名称
              </th>
              <th class="text-center">
                画像ファイル
              </th>
              <th class="text-center">
                アラート閾値
              </th>
              <th class="text-center">
                前回アラート<br>通知日時
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
              <form action="{{ url('sample/equip/edit_m_equip/' . $equip->id ) }}" method="post">
                @csrf
                <tr>
                  <td>
                    {{ $equip->id }}
                    <input type="hidden" name="id" value="{{ $equip->id }}">
                  </td>
                  
                  <td>
                    {{ $equip->m_dept->name_of_dept }}
                    <input type="hidden" name="m_dept_id" value="{{ $equip->m_dept_id }}">
                  </td>
                  <td>
                    {{ $equip->name_of_equipment }}
                    <input type="hidden" name="m_dept_id" value="{{ $equip->m_dept_id }}">
                  </td>
                  <td>
                    {{ $equip->image_name }}
                  </td>
                  <td class="text-center">
                    {{ $equip->notification_min_value }}
                  </td>
                  <td class="text-center">
                    {{ $equip->datetime_alert }}
                  </td>

                  @php
                    $index = 0;
                  @endphp

                  @foreach($equip->t_equipment_tags as $tag)
                    <td>
                      {{ $tag->name_of_tag }}
                    </td>
                    @php
                      $index++;
                    @endphp
                  @endforeach

                  @switch($index)
                    @case(0)
                      <td></td><td></td><td></td>
                      @break
                    @case(1)
                      <td></td><td></td>
                      @break
                    @case(2)
                      <td></td>
                      @break
                  @endswitch


                  <td>
                    <button>修正</button>
                  </td>
                  <td>
                    <button>削除</button>
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

        @section('script')

    </body>
</html>
