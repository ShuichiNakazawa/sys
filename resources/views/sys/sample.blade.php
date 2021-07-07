<!-- resources/views/sys/systems.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')
        <br>

        <div style="margin:0 auto; width: 50%">
          <h2 class="txt_center">サンプル</h2>
          <br><br>

          <a href="sample/equip">
            <button>備品管理システム</button>
          </a>
          <br>
          下記のID、パスワードを入力する事で利用可能です。
          <br>

          <table>
            <tr>
              <th class="draw_border txt_center">
                アカウントID
              </th>
              <th class="draw_border txt_center">
                パスワード
              </th>
              <th class="draw_border txt_center">
                権限
              </th>
            </tr>
            <tr>
              <td class="draw_border">
                guest_user
              </td>
              <td class="draw_border">
                guest_user
              </td>
              <td class="draw_border">
                総合管理者
              </td>
            </tr>
            <tr>
              <td class="draw_border">
                guest_user2
              </td>
              <td class="draw_border">
                guest_user2
              </td>
              <td class="draw_border">
                部門管理者
              </td>
            </tr>
            <tr>
              <td class="draw_border">
                guest_user3
              </td>
              <td class="draw_border">
                guest_user3
              </td>
              <td class="draw_border">
                一般ユーザー
              </td>
            </tr>
          </table>


          <br><br><br>

          <a href="sample/stripe_sample">
            <button>Stripe クレジットカード決済サンプルページ</button>
          </a>

          <br><br><br>

          <a href="sample/bc_laravel">
            <button>【書籍引用】Laravel入門</button>
          </a>
          <br><br><br>

          <a href="sample/p5">
            <button>p5.js</button>
          </a>
          <br><br><br>


        </div>
        <br><br><br>

        @endsection

        @section('footer')
        <div class="container copyright">
          &copy;2020 - 2021 lara-assist.jp
        </div>
      @endsection
    </body>
</html>
