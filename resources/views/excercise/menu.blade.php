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

            <div id="">
                <canvas id="" width="380" height="50">

                </canvas>
            </div>
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
                        <input type="radio" name="title_id" style="display: none;" id="title_{{ $title->title_id }}" value="{{ $title->title_id }}" v-on:click="onGetTitleId">
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
            <div>
                {{-- 回答履歴を表示するエリア --}}
                回答履歴 表示エリア
            </div>
            <div>
                <br>

                {{-- ランダム出題か年度指定かを表示 --}}

                {{-- 問題番号 --}}
                問&nbsp;(% question_number %)
                <br>

                {{-- 問題文 --}}
                (% question_sentence %)
                <br>

                {{-- 図の表示 --}}
                <template v-if="hasGrapgh">

                </template>

                {{-- 選択肢文 --}}
                {{-- 必須回答数によって、表示内容が異なる。radio か checkbox か --}}
                <template v-if="isSingleSelect">

                    {{-- ラジオボタンにバインド --}}
                    <template v-for="item in choices">
                        <input type="radio" name="choice" :id="item.choice_id">
                        <label class="btn-choice" :for="item.choice_id">(% arrayChoiceCharacter[item.choice_id] %)</label>(% item.choice_sentence %)

                        <br>
                    </template>

                </template>

                <template v-if="isMultiSelect">

                    {{-- チェックボックスにバインド --}}


                </template>


                {{-- 前の問題へ --}}
                <template v-if="isNotFirstQuestion">
                    <button v-on:click="onBeforeQuestion">前の問題へ</button>
                </template>

                {{-- 次の問題へ --}}
                <template v-if="isNotLastQuestion">
                    <button v-on:click="onNextQuestion">次の問題へ</button>
                </template>

                {{-- 結果判定 --}}
                <template v-if="isLastQuestion">
                    <button v-on:click="showResult">結果判定</button>
                </template>

            </div>
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
                isSelectQuestionFormatActive:   true,       // 進捗表

                isRandomTabActive:      true,               // ランダム出題コンテンツ
                isSelectYearTabActive:  false,              // 年度指定コンテンツ
                isStatisticsTabActive:  false,              // 統計情報コンテンツ

                // 出題モードフラグ
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


                // 問題文情報                
                question_number: 0,         // 問題番号
                question_sentence: "",      // 問題文
                hasGrapgh: false,           // 図表フラグ
                choices: [],                // 選択肢配列
                answers: [],                // 正答配列

                isSingleSelect: false,      // 必須回答数が１
                isMultiSelect:  false,      // 必須回答数が複数
                isNoSelect:     false,      // 必須回答数が０

                isSingleAnswer: false,      // 正解の数が１
                isMultiAnswer: false,       // 正解の数が複数
                isNoAnswer: false,          // 正解の数が０


                // 最初の問題ではない
                isNotFirstQuestion: false,

                // 最終問題ではない
                isNotLastQuestion:  true,

                // 最終問題である
                isLastQuestion: false,

                // 選択肢の文字列
                arrayChoiceCharacter: ['ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ'],
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

                        this.arrayQuestionSentences = data[0];

                        // 選択肢配列
                        this.arrayChoiceSentences = data[1];

                        // 正答配列
                        this.arrayAnswerSentences = data[2];

                        // 回答履歴配列
                        this.arrayCorrects = data[3];

                        console.log('arrayQuestionSentences[0]["question_sentence"]: ' + this.arrayQuestionSentences[0]["question_sentence"]);

                        //console.log('arrayQuestionSentences[91]["choice_sentence"]: ' + this.arrayQuestionSentences[91]["choice_sentence"]);

                        // 問題文情報 設定
                        this.question_number =   this.arrayQuestionSentences[0]["question_number"];         // 問題番号
                        this.question_sentence = this.arrayQuestionSentences[0]["question_sentence"];       // 問題文

                        this.required_numOfAnser = this.arrayQuestionSentences[0]["required_numOfAnswers"];     // 必須回答数
                        
                        // 必須回答数 判定
                        if(this.required_numOfAnser == 1){

                            // 必須回答数 １
                            this.isSingleSelect =   true;
                            this.isMultiSelect  =   false;
                            this.isNoSelect     =   false;

                        } else if(this.required_numOfAnser > 1){

                            // 必須回答数 複数
                            this.isSingleSelect =   false;
                            this.isMultiSelect  =   true;
                            this.isNoSelect     =   false;

                        } else if(this.required_numOfAnser == 0){

                            // 必須回答　無し
                            this.isSingleSelect =   false;
                            this.isMultiSelect  =   false;
                            this.isNoSelect     =   true;
                        }
                        

                        this.numberOfAnsers = this.arrayQuestionSentences[0]["number_of_answers"];     // 正解の数

                        if(this.numberOfAnsers == 1){

                            // 正解１つ
                            this.isSingleAnswer = true;
                        } else if(this.numberOfAnsers > 1){

                            // 正解複数
                            this.isSingleAnswer = false;
                            this.isMultiAnswer  = false;

                        } else if(this.numberOfAnsers == 0){

                            // 正答なし
                            this.isNoAnswer     = true;
                        }

                        this.choices = this.arrayChoiceSentences[0];                                          // 選択肢配列
                        this.answers = this.arrayAnswerSentences[0];                                          // 正答配列

                        console.log('選択肢配列["choice_sentence"]： ' + this.choices['choice_sentence']);

                        console.log('選択肢配列７番目の選択肢文： ' + this.arrayChoiceSentences[6]['choice_sentence']);

                        console.log('選択肢配列1： ' + this.choices[1]);
                        console.log('選択肢配列2： ' + this.choices[2]);
                        console.log('選択肢配列3： ' + this.choices[3]);
                        console.log('正答配列： ' + this.answers[0]);


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

                    // 出題コンテンツ フラグオン
                    this.isQuestionMode = true;

                    // 進捗表 オフ
                    this.isSelectQuestionFormatActive = false;  

                    // 進捗バー オフ

                    this.isRandomTabActive      =   false;  // ランダム出題コンテンツ オフ
                    this.isSelectYearTabActive  =   false;  // 年度指定コンテンツ オフ
                    this.isStatisticsTabActive  =   false;  // 統計情報コンテンツ オフ

                },

                onBeforeQuestion: function() {

                },

                onNextQuestion: function() {

                },

                onShowResult: function() {

                },
            },

            watch: {
                question_number: function (new_question_number, old_question_number){

                },

                question_sentence: function(new_question_sentence, old_question_sentence){

                }
            },


        })
    </script>
    {{--
    <script src="{{ asset('js/practice3_3.js') }}"></script>
    --}}
@endsection