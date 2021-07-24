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
                &nbsp;&nbsp;&nbsp;アカウントID&nbsp;&nbsp;&nbsp;
              </th>
              <th class="draw_border txt_center">
                &nbsp;&nbsp;&nbsp;パスワード&nbsp;&nbsp;&nbsp;
              </th>
              <th class="draw_border txt_center">
                &nbsp;&nbsp;&nbsp;権限&nbsp;&nbsp;&nbsp;
              </th>
            </tr>
            <tr>
              <td class="draw_border">
                &nbsp;&nbsp;&nbsp;guest_user&nbsp;&nbsp;&nbsp;
              </td>
              <td class="draw_border">
                &nbsp;&nbsp;&nbsp;guest_user&nbsp;&nbsp;&nbsp;
              </td>
              <td class="draw_border">
                &nbsp;&nbsp;&nbsp;総合管理者&nbsp;&nbsp;&nbsp;
              </td>
            </tr>
            <tr>
              <td class="draw_border">
                &nbsp;&nbsp;&nbsp;guest_user2&nbsp;&nbsp;&nbsp;
              </td>
              <td class="draw_border">
                &nbsp;&nbsp;&nbsp;guest_user2&nbsp;&nbsp;&nbsp;
              </td>
              <td class="draw_border">
                &nbsp;&nbsp;&nbsp;部門管理者&nbsp;&nbsp;&nbsp;
              </td>
            </tr>
            <tr>
              <td class="draw_border">
                &nbsp;&nbsp;&nbsp;guest_user3&nbsp;&nbsp;&nbsp;
              </td>
              <td class="draw_border">
                &nbsp;&nbsp;&nbsp;guest_user3&nbsp;&nbsp;&nbsp;
              </td>
              <td class="draw_border">
                &nbsp;&nbsp;&nbsp;一般ユーザー&nbsp;&nbsp;&nbsp;
              </td>
            </tr>
          </table>


          <br><br><br>

          <a href="sample/stripe_sample">
            <button>Stripe クレジットカード決済サンプルページ</button>
          </a>

          <br><br><br>

          <a href="sample/p5">
            <button>p5.js</button>
          </a>
          <br><br><br>

          <a href="sample/bc_laravel">
            <button>【書籍引用】Laravel入門書籍</button>
          </a>
          <br><br><br>

          <a href="sample/bc_vue_tubokotu">
            <button>【書籍引用】Vue.jsのツボとコツがゼッタイにわかる本</button>
          </a>
          <br><br><br>

          <a href="sample/bc_css_grid">
            <button>【書籍引用】CSSグリッドレイアウト</button>
          </a>
          <br><br><br>

          <a href="https://appli-support.jp/deliveryManagement/index.html">
            <button>デリバリー管理システム（開発中断）</button>
          </a>

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
