<!-- resources/views/rooms/management.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div id="app" class="">
  <div class="" style="text-align: center;">
    <h3>国試 管理画面トップ</h3>
  </div>
  <div class="row">
    

    <div class="" style="">
      <br><br><br>
      <div style="z-index: 20;">
        <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; z-index: 30; position: relative;">
          <div style="background: lightblue; width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; z-index: 10;">
            <div style="background: lightblue; width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white; z-index: 10;">
              <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px; z-index: 10;">
                <p style="font-size: 20px;">問題分類<br>管理</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      

      
      <div style="z-index: 10;">
        <div style="background: white; width: 200px; height: 100px; margin-left: 50px; margin-bottom: 50px; border-radius: 10px; z-index: 20; position: relative;">
          <div style="background: rgb(48, 105, 96); width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; z-index: 10;">
            <div style="background: rgb(48, 105, 96); width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
              <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute; text-align: center; padding-top: 7px;">
                <p style="font-size: 20px;">問題文・解説<br>管理</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br>
    </div>


    <br><br>
    <div style="z-index: 5; width: 80%;">
      <br>
      <div class="row" style="margin-left: 30px; z-index: 5;">
        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5;" v-on:click="onSubjectGroupTab">
          科目グループ
        </div>
        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5" v-on:click="onSubjectTab">
          科目
        </div>

        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5" v-on:click="onTitleTab">
          タイトル
        </div>
        <div style="margin-right: 15px; border: solid 4px lightgray; font-size: 20px; width: 150px; text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px; z-index: 5" v-on:click="onFieldTab">
          分野
        </div>
      </div>
      
        <div style="background: lightgray; text-align: center; padding-top: 10px; max-width: 100%; height: 800px; margin-top: -3px; margin-left: -50px; border: solid 3px lightgray; border-radius: 15px; z-index: 5;">
          <div style="background: white; margin-left: 70px; margin-right: 20px; border-radius: 20px; z-index: 5;">
            <br>

            <div class="row" style="margin: 0 auto; font-size: 20px; z-index: 5;">
              <div style="width: 30%">
              </div>
              <div style="margin: 0 auto;">
                <div class="btn-choice">
                    登録
                </div>
              </div>

              <div style="margin: 0 auto;">
                <div class="btn-choice">
                  一覧表示
                </div>

              </div>
              <div style="width: 30%">
              </div>
            </div>
            <br>

          </div>

          <div style="z-index: 5;">
            <br>
          </div>

          <!-- 科目グループ登録 -->
          <div id="registSubjectGroup" v-bind:class="[isRegSubGrpActive ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px; z-index: 5;">
            <br>
            <h4>科目グループ 登録</h4>

            <div class="card-body">
              <form action="{{ action('KokushiManagementController@storeSubjectGroup') }}" method="POST">
                @csrf

                <div style="text-align: left; padding-left: 20px;">


                  <p>
                    <label for="subject_group_name">科目グループ名：</label>
                    <input typt="text" name="subject_group_name" id="subject_group_name" value="" size="30">
                  </p>
                  <p>
                    <input type="submit" value="登録">
                  </p>
                </div>
              </form>
          
            </div>
          </div>

          <!-- 科目グループリスト -->
          <div id="subjectGroupList" v-bind:class="[isSubGrpLstActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px; display: none;">
            <br>
            <h4>科目グループリスト</h4>

            <div class="card-body">
              <form action="{{ action('KokushiManagementController@storeSubjectGroup') }}" method="POST">
                @csrf

                <div style="text-align: left; padding-left: 20px;">


                  <p>
                    <label for="subject_group_name">科目グループ名：</label>
                    <input typt="text" name="subject_group_name" id="subject_group_name" value="" size="30">
                  </p>
                  <p>
                    <input type="submit" value="登録">
                  </p>
                </div>
              </form>
          
            </div>
          </div>

          <!-- 科目登録 -->
          <div id="registSubject" v-bind:class="[isRegSubActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
            <br>
            <h4>科目登録</h4>

            <div class="card-body">
              <form action="{{ action('ExcerciseManagementController@storeSubject') }}" method="POST">
                @csrf

                <div style="text-align: left; padding-left: 20px;">


                  <p>
                    <label for="subject_name">科目名：</label>
                    <input typt="text" name="subject_name" id="subject_name" value="" size="30">
                  </p>
                  <p>
                    <input type="submit" value="登録">
                  </p>
                </div>
              </form>
          
            </div>
          </div>

          <!-- 科目リスト -->
          <div id="subjectList" v-bind:class="[isSubLstActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
            科目リスト
          </div>

          <!-- タイトル登録 -->
          <div id="registTitle" v-bind:class="[isRegTitActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
            タイトル登録
          </div>

          <!-- タイトルリスト -->
          <div id="titleList" v-bind:class="[isTitLstActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
            タイトルリスト
          </div>

          <!-- 分野登録 -->
          <div id="registField" v-bind:class="[isRegFldActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
            分野登録
          </div>

          <!-- 分野リスト -->
          <div id="fieldList" v-bind:class="[isfldLstActive === true ? 'activeDiv' : 'inactiveDiv']" style="background: white; height: 500px; margin-left: 70px; margin-right: 20px; border-radius: 20px;">
            分野リスト
          </div>

        </div>
      </div>
      <br><br>


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


  </div>
  <br>

  <div class="listArea">
    <div class="innerList">

      <!-- TOP  -->


    </div>
  </div>

@endsection

@section('script')
  <script src="https://jp.vuejs.org/js/vue.js"></script>
  <script>
    var app = new Vue({
      el: '#app',
      data: {
        tabNumber: 1,
        modeNumber: 1,

        isRegSubGrpActive: true,
        isSubGrpLstActive: false,

        isRegSubActive: false,
        isSubLstActive: false,

        isRegTitActive: false,
        isTitLstActive: false,

        isRegFldActive: false,
        isFldLstActive: false,

      },

      methods: {
        // 科目グループタブのクリックイベントハンドラ
        onSubjectGroupTab: function() {
          console.log('科目グループタブ 押下');

          // inactiveクラスを科目コンテンツ、タイトルコンテンツ、分野コンテンツに設定する
          // activeクラスを科目グループコンテンツへ設定する

          // 登録と一覧表示の、どっちが押下されているかによって、アクティブにするコンテンツが変わるため、条件分岐が必要
          this.isRegSubGrpActive = true;      // 科目グループ登録エリア 有効化
          this.isSubGrpLstActive = false;

          console.log('科目グループ登録アクティブフラグ：' + this.isRegSubGrpActive);

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = false;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;

        },


        // 科目タブのクリックイベントハンドラ
        onSubjectTab: function() {
          console.log('科目タブ 押下');

          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = true;     // 科目登録エリア 有効化
          this.isSubLstActive     = false;

          this.isRegTitActive     = false;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;
        },


        // タイトルタブのクリックイベントハンドラ
        onTitleTab: function() {
          console.log('タイトルタブ 押下');

          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = true;     // タイトル登録エリア 有効化
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;
          this.isFldLstActive     = false;
        },

        // 分野タブのクリックイベントハンドラ
        onFieldTab: function() {
          console.log('分野タブ 押下');
          this.isRegSubGrpActive = false;
          this.isSubGrpLstActive = false;

          this.isRegSubActive     = false;
          this.isSubLstActive     = false;

          this.isRegTitActive     = true;
          this.isTitLstActive     = false;

          this.isRegFldActive     = false;    // 分野登録エリア 有効化
          this.isFldLstActive     = false;
        },

        // 登録ボタンのクリックイベントハンドラ
        onStoreItem: function() {
          console.log('登録ボタン 押下');
          // 登録モードへ変更
          modeNumber = 1;

          // 表示させるコンテンツを切り替える

        },


        
        onListItem: function() {
          console.log('一覧表示ボタン 押下');
          // 一覧表示モードへ変更
          modeNumber = 2;

          // 表示させるコンテンツを切り替える
        }


      },



    })
  </script>
@endsection