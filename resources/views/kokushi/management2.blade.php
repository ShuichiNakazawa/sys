<!-- resources/views/rooms/management.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="">
  <div class="">
    <h3>国試 管理画面トップ</h3>
  </div>
  <div class="" style="margin: 0 auto;">

    
    <div style="background: lightgray; text-align: center; padding-top: 10px; width: 80%; margin: 0 auto; border: solid 3px lightgray; border-radius: 15px;">
      <h4>問題区分管理</h4>
      <div style="background: white;">

        <div class="row">

          <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; padding-top: 15px;">
            <div style="background: lightblue; width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
              <div style="background: lightblue; width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px;">
                  <h4>科目グループ</h4>
                  <a href="{{ url('/kokushi/management/store_subject_group') }}">
                    <button>登録</button>
                  </a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{  url('/kokushi/management/subject_group_list') }}">
                    <button>一覧表示</button>
                  </a>
                  <img src="" alt="">
                </div>
              </div>
            </div>
          </div>
        

          <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; padding-top: 15px;">
            <div style="background: lightblue; width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
              <div style="background: lightblue; width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px;">
                  <h4>科目</h4>
                    <a href="{{ url('/kokushi/management/store_subject') }}">
                    <button>登録</button>
                  </a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{  url('/kokushi/management/subject_list') }}">
                    <button>一覧表示</button>
                  </a>
                  <img src="" alt="">
                </div>
              </div>
            </div>
          </div>


          <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; padding-top: 15px;">
            <div style="background: lightblue; width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
              <div style="background: lightblue; width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px;">
                  <h4>問題タイトル</h4>
                  <a href="{{ url('/kokushi/management/store_title') }}">
                    <button>登録</button>
                  </a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{ url('/kokushi/management/title_list/0') }}">
                    <button>一覧表示</button>
                  </a>
                  <img src="" alt="">
                </div>
              </div>
            </div>
          </div>


          <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; padding-top: 15px;">
            <div style="background: lightblue; width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
              <div style="background: lightblue; width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px;">
                  <h4>分野</h4>
                  <button>登録</button>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <button>一覧表示</button>
                  {{--
                  <a href="{{ url('/kokushi/management/store_title') }}">
                    <button>登録</button>
                  </a>
                  --}}
    {{--
                  <a href="{{ url('/kokushi/management/title_list/0') }}">
                    <button>一覧表示</button>
                  </a>
                  --}}

                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <br><br>


    <div style="background: lightgray; text-align: center; padding-top: 10px; width: 80%; margin: 0 auto; border: solid 3px lightgray; border-radius: 10px;">
      <h4>問題文管理</h4>
      <div style="background: white;">
        <div class="row">

          <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; padding-top: 15px;">
            <div style="background: rgb(48, 105, 96); width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
              <div style="background: rgb(48, 105, 96); width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px;">
                  <h4>問題文</h4>
                  <a href="{{ url('/kokushi/management/store_q_sentence') }}">
                    <button>登録</button>
                  </a>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{ url('/kokushi/management/qsentence_list') }}">
                    <button>一覧表示</button>
                  </a>
                  <img src="" alt="">
                </div>
              </div>
            </div>
          </div>

          <div style="background: white; width: 200px; height: 100px; margin-left: 50px; border-radius: 10px; padding-top: 15px;">
            <div style="background: rgb(48, 105, 96); width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
              <div style="background: rgb(48, 105, 96); width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px;">
                  <h4>解説文</h4>
                  <button>登録</button>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  <button>一覧表示</button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
{{--
<div class="card-body">
  <div class="card-body">
    <h3>国試 管理画面トップ</h3>
  </div>
  <div class="card-body">

    <div class="card-body">
      <h4>科目グループ</h4>
      <a href="{{ url('/kokushi/management/store_subject_group') }}">
        <button>登録</button>
      </a>

      <a href="{{  url('/kokushi/management/subject_group_list') }}">
        <button>一覧表示</button>
      </a>
    </div>

    <div class="card-body">
      <h4>科目</h4>
      <a href="{{ url('/kokushi/management/store_subject') }}">
        <button>登録</button>
      </a>

      <a href="{{  url('/kokushi/management/subject_list') }}">
        <button>一覧表示</button>
      </a>
    </div>

    <div class="card-body">
      <h4>問題タイトル</h4>
      <a href="{{ url('/kokushi/management/store_title') }}">
        <button>登録</button>
      </a>
      <a href="{{ url('/kokushi/management/title_list/0') }}">
        <button>一覧表示</button>
      </a>
    </div>
    <div class="card-body">
      <h4>分野</h4>
      <button>登録</button>
      <button>一覧表示</button>
    </div>
  </div>

  <div class="card-body">
    <div class="card-body">
      <h4>問題文</h4>
      <a href="{{ url('/kokushi/management/store_q_sentence') }}">
        <button>登録</button>
      </a>
      <a href="{{  url('/kokushi/management/qsentence_list') }}">
        <button>一覧表示</button>
      </a>
    </div>
    <div class="card-body">
      <h4>解説文</h4>
      <button>登録</button>
      <button>一覧表示</button>
    </div>
  </div>
--}}


  
  {{--
  <form action="{{ action('KokushiController@merge') }}" method="post">
    @csrf
      <input type="submit" name="migration_table" value="t_choices データ移行">
  </form>

  <form action="{{ action('KokushiController@merge') }}" method="post">
    @csrf
      <input type="submit" name="migration_table" value="t_answers データ移行">
  </form>
  --}}

</div>
<br>

  <div class="listArea">
    <div class="innerList">

      <!-- TOP  -->


    </div>
  </div>
@endsection
