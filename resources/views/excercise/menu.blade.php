@extends('layouts.app_excercise')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')
    <br>
    <div style="width: 90%; margin: 0 auto;">
        <h3>{{ $subject_name }} 過去問</h3>
        <input type="hidden" name="subject_id" id="subject_id" value="{{ $subject_id }}">
        <div style="text-align: left;">
            ゲストユーザー
        </div>


        {{-- 出題形式選択 --}}
        {{-- 初回に表示、出題時は非表示、出題形式選択で再表示 --}}
        <div style="margin: 0 auto;" v-bind:class="[isSelectQuestionFormatActive ? 'selectQuestionFormatActive' : 'inactiveDiv']">
            <table>
                <tr>
                    <td>
                        <i>
                            <span style="color: red; font-weight: bold;">P</span><span style="color: orange; font-weight: bold;">e</span><span style="color: yellow; font-weight: bold;">r</span><span style="color: lightgreen; font-weight: bold;">f</span><span style="color: lightblue; font-weight: bold;">e</span><span style="color: blue; font-weight: bold;">c</span><span style="color: purple; font-weight: bold;">t</span>
                        </i>
                    </td>
                    <td>
                        <i>
                            <span style="color: green; font-weight: bold;">
                                Stable
                            </span>
                        </i>
                    </td>
                    <td>
                        <i>
                            <span style="color: blue; font-weight: bold;">
                                Good
                            </span>
                        </i>
                    </td>
                    <td>
                        <i>
                            <span style="color: red; font-weight: bold;">
                                Bad
                            </span>
                        </i>
                    </td>
                    <td>
                        <i>
                            <span style="color: gray; font-weight: bold;">
                                No look
                            </span>
                        </i>
                    </td>
                </tr>

                <tr>
                    @if( Auth::user() !== null )
                        <td style="text-align: center;">
                            Perfectの数
                        </td>
                        <td style="text-align: center;">
                            Stableの数
                        </td>
                        <td style="text-align: center;">
                            Goodの数
                        </td>
                        <td style="text-align: center;">
                            Badの数
                        </td>
                        <td style="text-align: center;">
                            No lookの数
                        </td>
                    @else
                        <td style="text-align: center;">
                            --
                        </td>
                        <td style="text-align: center;">
                            --
                        </td>
                        <td style="text-align: center;">
                            --
                        </td>
                        <td style="text-align: center;">
                            --
                        </td>
                        <td style="text-align: center;">
                            --
                        </td>           
                    @endif
                </tr>
            </table>
            棒グラフ表示<br>
            <br><br>

            {{-- メニュータブ --}}
            <div class="row" style="text-align: center;">
                <div v-bind:class="[isRandomTabActive ? 'randomTabActive' : 'tabInactive']" style="padding: 5px; margin-left: 10px; width: 120px; z-index: 10; border-top: solid 4px rgb(73, 172, 157);; border-left: solid 4px rgb(73, 172, 157);; border-right: solid 4px rgb(73, 172, 157);; border-top-left-radius: 10px; border-top-right-radius: 10px; background:white; color: rgb(73, 172, 157);" v-on:click="onRandomTab">
                    <b>ランダム出題</b>
                </div>
                <div v-bind:class="[isSelectYearTabActive ? 'selectYearTabActive' : 'tabInactive']" style="padding: 5px; margin-left: 15px; width: 100px; background: white; z-index: 10; border-top: solid 4px darkblue; border-left: solid 4px darkblue; border-right: solid 4px darkblue; border-top-left-radius: 10px; border-top-right-radius: 10px; color: darkblue;" v-on:click="onSelectYearTab">
                    <b>年度指定</b>
                </div>

                @if( Auth::user() !== null )
                    <div v-bind:class="[isStatisticsTabActive ? 'statisticsTabActive' : 'tabInactive']" style="padding: 5px; margin-left: 15px; width: 100px; background: white; z-index: 10; border-top: solid 4px rgb(175, 139, 62); border-left: solid 4px rgb(175, 139, 62); border-right: solid 4px rgb(175, 139, 62); border-top-left-radius: 10px; border-top-right-radius: 10px; color: rgb(175, 139, 62);" v-on:click="onStatisticsTab">
                        <b>統計情報</b>
                    </div>
                @else
                    <div style="padding: 5px; margin-left: 15px; width: 100px; background: white; z-index: 10; border-top: solid 4px lightgray; border-left: solid 4px lightgray; border-right: solid 4px lightgray; border-top-left-radius: 10px; border-top-right-radius: 10px; color: lightgray;">
                        <b>統計情報</b>
                    </div>
                @endif
            </div>

            {{-- ランダム出題コンテンツ --}}
            <div class="row" v-bind:class="[isRandomTabActive ? 'randomTabActive' : 'inactiveDiv']" id="random_question" style="border: solid 5px rgb(73, 172, 157);; border-radius: 10px; width: 380px; background: white;">
                <div style="padding-left: 30px;">
                    <br>
                    <div style="width: 130px; background: rgb(73, 172, 157); color: white; font-weight: bold; text-align: center; border-top-right-radius: 25px; border-bottom-right-radius: 25px;" v-on:click="onStartQuestion">
                        出題スタート
                    </div>
                    </div>
                    <div style="width: 100%;">
                </div>

                <div style="margin: 25px;">
                    <input type="radio" name="numOfQuestion" id="question10" style="display: none;" v-on:click="onSet10">
                    <label for="question10" class="btn-choice">１０問</label>
                </div>
                <div style="margin: 25px;">
                    <input type="radio" name="numOfQuestion" id="question30" style="display: none;" v-on:click="onSet30">
                    <label for="question30" class="btn-choice">３０問</label>
                </div>
                <div style="margin: 25px;">
                    <input type="radio" name="numOfQuestion" id="question50" style="display: none;" v-on:click="onSet50">
                    <label for="question50" class="btn-choice">５０問</label>
                </div>
                <div style="margin: 25px;">
                    <input type="radio" name="numOfQuestion" id="question100" style="display: none;" v-on:click="onSet100">
                    <label for="question100" class="btn-choice">１００問</label>
                </div>
                <div style="width: 100%;">

                </div>
                <br><br>

            </div>


            {{-- 年度指定コンテンツ --}}
            <div class="row inactive" v-bind:class="[isSelectYearTabActive ? 'SelectYearTabActive' : 'inactiveDiv']" id="selected_question" style="border: solid 5px darkblue; border-radius: 10px; max-width: 700px; background: white;">

                <div style="padding-left: 30px;">
                    <br>
    
                    <div style="width: 130px; background: darkblue; color: white; font-weight: bold; text-align: center; border-top-right-radius: 25px; border-bottom-right-radius: 25px;" v-on:click="onStartQuestion">
                        出題スタート
                    </div>
                    <br>
                </div>

                <div style="width: 100%;">

                </div>

                @php
                    $index = 0;
                @endphp

                @foreach($titles as $title)

                    @if($index % 2 == 0)
                        <div class="row" style="margin: 10px;">
                    @endif

                    <div style="margin: 10px; width: 135px;">
                        <input type="radio" name="title_id" id="title_{{ $title->title_id }}" value="{{ $title->title_id }}" style="display: none;" v-on:click="onGetTitleId">
                        <label for="title_{{ $title->title_id }}" class="btn-choice">
                            {{ $title->question_title }}
                        </label>
                    </div>

                    @if($index % 2 == 1)
                        </div>
                    @endif

                    @php
                        $index++;
                    @endphp
                @endforeach

                <div style="width: 100%;">

                </div>
                <div style="padding-left: 30px;">
                    <div style="width: 130px; background: darkblue; color: white; font-weight: bold; text-align: center; border-top-right-radius: 25px; border-bottom-right-radius: 25px;" v-on:click="onStartQuestion">
                        出題スタート
                    </div>
                    <br><br>
                </div>
            </div>
        </div>

        {{-- 出題画面 --}}
        <div v-bind:class="[isQuestionMode ? 'questionModeActive' : 'inactiveDiv']" style="border: solid 5px rgb(73, 172, 157); border-radius: 10px; width: 380px; background: white;">

        </div>
    </div>




    <div></div>
    <div></div>
    <div></div>

@endsection

@section('script')
    <script src="https://jp.vuejs.org/js/vue.js"></script>
    <script>
        
        var app = new Vue({
            delimiters: ["(%","%)"] ,
            el: '#app',
            data: {
                // タブ有効フラグ
                isSelectQuestionFormatActive:   true,
                isRandomTabActive:      true,
                isSelectYearTabActive:  false,
                isStatisticsTabActive:  false,

                //
                isQuestionMode: false,

                // ランダム出題数
                number_randomQuestion: 0,

                //
                title_id: 0,

                questionInfo: "",

                // 問題文配列
                arrayQustionSentences: [],

                // 選択肢配列
                arrayChoiceSentences: [],

                // 正答配列
                arrayAnswerSentences: [],

                // 回答履歴配列
                arrayCorrects: [],

            },

            methods: {
                // 科目グループタブのクリックイベントハンドラ
                onRandomTab: function() {
                    console.log('ランダム出題タブ 押下');

                    // 登録と一覧表示の、どっちが押下されているかによって、アクティブにするコンテンツが変わるため、条件分岐が必要
                    this.isRandomTabActive      = true;
                    this.isSelectYearTabActive  = false;
                    this.isStatisticsTabActive  =   false;

                },

                onSelectYearTab: function() {
                    console.log('年度指定タブ 押下');

                    //
                    this.isRandomTabActive      =   false;
                    this.isSelectYearTabActive  =   true;
                    this.isStatisticsTabActive  =   false;
                    
                },

                onStatisticsTab: function() {
                    console.log('統計情報タブ 押下');

                    this.isRandomTabActive      =   false;
                    this.isSelectYearTabActive  =   false;
                    this.isStatisticsTabActive  =   true;
                },

                onSet10: function() {
                    console.log('ランダム１０設定');
                    // ランダム出題数 設定
                    this.number_randomQuestion = 10;
                },

                onSet30: function() {
                    console.log('ランダム３０設定');
                    // ランダム出題数 設定
                    this.number_randomQuestion = 30;
                },

                onSet50: function() {
                    console.log('ランダム５０設定');
                    // ランダム出題数 設定
                    this.number_randomQuestion = 50;
                },

                onSet100: function() {
                    console.log('ランダム１００設定');
                    // ランダム出題数 設定
                    this.number_randomQuestion = 100;
                },

                onGetTitleId: function() {
                    console.log('タイトル取得');

                    this.title_id = $('input[name="title_id"]:checked').val();

                    console.log('title_id: ' + this.title_id);
                },

                onStartQuestion: function() {

                    console.log('出題スタート');

                    // 出題形式 取得（ランダムか年度指定か）
                    if(this.isRandomTabActive == true){

                        // ランダム出題
                        // APIに投げる値を変更（ランダムモードと問題数が渡せればOK）
                        var reqString1 = 'get_random';
                        var reqString2 = this.number_randomQuestion;
                        //var getMode = 'get_random';
                        //var reqString = getMode + '/' + this.number_randomQuestion;

                    } else if(this.isSelectYearTabActive == true){

                        // 年度指定出題
                        // APIに投げる値を変更（年度指定モードとタイトルが渡せればOK
                        var reqString1 = 'get_title';
                        var reqString2 = this.title_id;

                        //var getMode = 2;
                        //var reqString = getMode + '/' + this.title_id;
                    }

                    var subject_id = $('#subject_id').val();

                    var reqString = subject_id + '/' + reqString1 + '/' + reqString2;

                    console.log('reqString: ' + reqString);

                    //var url = "http://localhost:8080/excercise_menu/" + reqString;
                    var url = "https://lara-assist.jp/excercise_menu/" + reqString;

                    console.log('url: ' + url);

                    // APIを投げて、問題文、選択肢文、正答文、回答履歴を取得
                    $.ajax({
                        url :   url,
                        type:   'GET',
                        dataType:   'json',
                    })
                    .done(function(data, textStatus, jqXHR) {
                        console.log('ajax成功');

                        this.questionInfo = data;
                    }.bind(this))
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('ajax失敗');
                        console.log('jqXHR: ' + jqXHR);
                        console.log('textStatus: ' + textStatus);
                        console.log('errorThrown: ' + errorThrown);
                        this.isError = true;
                        this.message = '問題文の読込に失敗しました。';
                    }.bind(this));
                    //})
                    //});


                },
            },


        })
    </script>
    {{--
    <script src="{{ asset('js/practice3_3.js') }}"></script>
    --}}
@endsection