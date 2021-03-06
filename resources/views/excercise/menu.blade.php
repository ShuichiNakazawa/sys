@extends('layouts.app_excercise')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')
    <br>

    <div style="margin: 0 auto; text-align: center;">
    {{--
    <div style="width: 90%; margin: 0 auto; text-align: center;">
        --}}
        <h3>{{ $subject_name }} 過去問</h3>
        <input type="hidden" name="subject_id" id="subject_id" value="{{ $subject_id }}">
        <div style="text-align: left; margin-left: auto; margin-right: auto; max-width: 500px; width: 320px;">
            
            @if( Auth::user() === null )
                ゲストユーザー
                &nbsp;     <a href="/login?redirect_to={{ urlencode(request()->url()) }}"><div class="btn-choice">ログイン</div></a>
                {{--
                &nbsp;     <a href="/excercise_menu/{{ $subject_id}}/login?sysid=2&param={{ $subject_id}}"><div class="btn-choice">ログイン</div></a>
                --}}
                {{--
                &nbsp;     <a href="/login"><div class="btn-choice">ログイン</div></a>
                --}}
            @elseif( Auth::user() !== null )
                {{ Auth::user()->name }}
            @endif
        </div>

        {{-- 正誤履歴表示 --}}
        {{-- 初回に表示、出題時は非表示、出題形式選択で再表示 --}}
        <div style="margin: 0 auto; max-width: 750px;" v-bind:class="[isSelectQuestionFormatActive ? 'selectQuestionFormatActive' : 'inactiveDiv']">
            <table style="max-width: 700px; margin: auto;">
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
                            {{ $numberPerfect }}
                        </td>
                        <td style="text-align: center;">
                            {{ $numberStable }}
                        </td>
                        <td style="text-align: center;">
                            {{ $numberGood }}
                        </td>
                        <td style="text-align: center;">
                            {{ $numberBad }}
                        </td>
                        <td style="text-align: center;">
                            {{ $numberNoLook }}
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
            <div class="row" style="text-align: center; margin: auto; width: 100%;">
                <div v-bind:class="[isRandomTabActive ? 'randomTabActive' : 'tabInactive']" style="padding: 5px; margin-left: 30px; width: 115px; z-index: 10; border-top: solid 4px rgb(73, 172, 157);; border-left: solid 4px rgb(73, 172, 157);; border-right: solid 4px rgb(73, 172, 157);; border-top-left-radius: 10px; border-top-right-radius: 10px; background:white; color: rgb(73, 172, 157);" v-on:click="onRandomTab">
                    <b>ランダム出題</b>
                </div>
                <div v-bind:class="[isSelectYearTabActive ? 'selectYearTabActive' : 'tabInactive']" style="padding: 5px; margin-left: 5px; width: 90px; background: white; z-index: 10; border-top: solid 4px darkblue; border-left: solid 4px darkblue; border-right: solid 4px darkblue; border-top-left-radius: 10px; border-top-right-radius: 10px; color: darkblue;" v-on:click="onSelectYearTab">
                    <b>年度指定</b>
                </div>

                <div v-bind:class="[isStatisticsTabActive ? 'statisticsTabActive' : 'tabInactive']" style="padding: 5px; margin-left: 5px; width: 90px; background: white; z-index: 10; border-top: solid 4px rgb(175, 139, 62); border-left: solid 4px rgb(175, 139, 62); border-right: solid 4px rgb(175, 139, 62); border-top-left-radius: 10px; border-top-right-radius: 10px; color: rgb(175, 139, 62);" v-on:click="onStatisticsTab">
                    <b>統計情報</b>
                </div>

            </div>

            {{-- ランダム出題コンテンツ --}}
            <div class="row justify-content-around" v-bind:class="[isRandomTabActive ? 'randomTabActive' : 'inactiveDiv']" id="random_question" style="border: solid 5px rgb(73, 172, 157); border-radius: 10px; margin: auto; width: 95%;  background: white;">
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
            <div class="row inactive justify-content-around" v-bind:class="[isSelectYearTabActive ? 'SelectYearTabActive' : 'inactiveDiv']" id="selected_question" style="border: solid 5px darkblue; border-radius: 10px; margin: auto; max-width: 95%; background: white;">

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
                    
                        <div class="row justify-content-around" style="">
                        {{--
                        <div class="row" style="margin: 10px;">
                            --}}
                    @endif

                    <div style="margin: 10px; width: 150px;">
                    {{--
                    <div style="margin: 10px; width: 135px;">
                    --}}
                        <input type="radio" name="title_id" style="display: none;" id="title_{{ $title->title_id }}" value="{{ $title->title_id }}" v-on:click="onGetTitleId">
                        <label for="title_{{ $title->title_id }}" class="btn-choice" style="width: 135px;">
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


                <div style="padding-left: 30px;">
                    <div style="width: 130px; background: darkblue; color: white; font-weight: bold; text-align: center; border-top-right-radius: 25px; border-bottom-right-radius: 25px;" v-on:click="onStartQuestion">
                        出題スタート
                    </div>
                    <br><br>
                </div>
            </div>


            {{-- ランダム出題コンテンツ --}}
            <div class="" v-bind:class="[isStatisticsTabActive ? 'statisticsTabActive' : 'inactiveDiv']" id="statistics" style="border: solid 5px rgb(175, 139, 62); border-radius: 10px; margin: auto; width: 95%;  background: white;">
                <div class="row justify-content-around">
                    <div style="margin: 25px;">
                        本日の利用者数
                    </div>
                    <div style="margin: 25px;">
                        累積利用者数
                    </div>
                </div>

                <div style="margin: auto;">
                    <h4>最近の挑戦者</h4>
                    <table style="margin: auto;">
                        <tr>
                            <th>
                                ユーザー名
                            </th>
                            <th>
                                年度
                            </th>
                            <th>
                                スコア
                            </th>                            
                        </tr>
                        <tr>
                            <td>
                                ユーザー名を取得
                            </td>
                            <td>
                                年度【テーブルから取得】
                            </td>
                            <td>
                                スコア【テーブルから取得】
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="margin: 25px;">
                </div>
                <div style="margin: 25px;">
                </div>
                <br><br>

            </div>



        </div>
        
        {{-- 出題画面 --}}
        <div v-bind:class="[isQuestionMode ? 'questionModeActive' : 'inactiveDiv']" style="border: solid 5px rgb(73, 172, 157); border-radius: 10px; margin: auto; width: 60%; background: white;">
            <div>
                {{-- 正誤履歴を表示するエリア --}}
                正誤履歴 表示エリア
            </div>
            <div style="text-align: left; padding: 5px;">
                <br>

                {{-- ランダム出題か年度指定かを表示 --}}

                {{-- 問題番号 --}}
                問&nbsp;(% question_number %)
                <br>

                {{-- 問題文 --}}
                (% question_sentence %)
                <br><br>

                {{-- 図の表示 --}}
                <template v-if="hasGraph">
                    (% this.graphFileName %)
                    <figure style="margin: 0 auto; text-align: center;">
                        {{-- assetとかどうなる？ --}}
                        <img v-bind:src="this.graphFileName" alt="問題文_図" width="80%" min-width="50%" height="auto">
                    </figure>
                </template>

                {{-- 変数チェック --}}
                {{--
                isSingleSelect: (% isSingleSelect %)
                <br>

                choices: (% choices %)
                --}}

                {{-- 選択肢文 --}}
                {{-- 必須回答数によって、表示内容が異なる。radio か checkbox か --}}
                <template v-if="isSingleSelect">

                    {{-- ラジオボタンにバインド --}}
                    <template v-for="item in choices">
                        <div style="display: flex; align-items: center;">
                            <div style="align-items: center; width: 45px;">
                                <input type="radio" name="choice" :id="item.choice_id" style="display: none;" v-model="radioAnswer"  :value="item.choice_id">
                                <label class="btn-choice" :for="item.choice_id">(% arrayChoiceCharacter[item.choice_id] %)</label>
                            </div>
                            <div style="margin-left: 10px;">
                                (% item.choice_sentence %)
                            </div>
                        </div>
                        <br>
                    </template>

                </template>

                <template v-if="isMultiSelect">

                    {{-- チェックボックスにバインド --}}
                    <template v-for="item in choices">
                        <div style="display: flex; align-items: center;">
                            <div style="align-items: center; width: 45px;">
                                <input type="checkbox" name="choice" :id="item.choice_id" style="display: none;" v-model="checkboxAnswer" :value="item.choice_id">
                                <label class="btn-choice" :for="item.choice_id">(% arrayChoiceCharacter[item.choice_id] %)</label>
                            </div>
                            <div style="margin-left: 10px;">
                                (% item.choice_sentence %)
                            </div>
                        </div>
                        <br>
                    </template>

                </template>

                <div class="row" style="margin-left: 30px; ">

                    {{-- 前の問題へ --}}
                    <template v-if="isNotFirstQuestion">
                        <div style="width: 100px; text-align: center; background:rgb(73, 172, 157); border-top-left-radius: 15px; border-bottom-left-radius: 15px; color: white; font-weight: bold;" v-on:click="onBeforeQuestion">前の問題へ</div>
                    </template>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    {{-- 次の問題へ --}}
                    <template v-if="isNotLastQuestion">
                        {{--
                        <button v-on:click="onNextQuestion">次の問題へ</button>
                        --}}
                        <div style="width: 100px; text-align: center; background:rgb(73, 172, 157); border-top-right-radius: 15px; border-bottom-right-radius: 15px; color: white; font-weight: bold;" v-on:click="onNextQuestion">次の問題へ</div>
                    </template>

                    {{-- 結果判定 --}}
                    <template v-if="isLastQuestion">
                        {{--
                        <button v-on:click="onShowResult">結果判定</button>
                        --}}
                        <div style="width: 100px; text-align: center; background:rgb(73, 172, 157); border-radius: 15px; color: white; font-weight: bold;" v-on:click="onShowResult">結果判定</div>
                    </template>
                </div>
                <br>

                {{-- テスト用表示項目 --}}
                {{--
                問題番号： (% question_number %)
                <br>

                インデックス：(% indexQuestion %)
                <br>

                選択済み配列：(% arraySelectedChoice %)
                <br>

                isSingleSelect: (% isSingleSelect %)
                <br>

                isMultiSelect: (% isMultiSelect %)
                <br>

                isNoSelect: (% isNoSelect %)
                <br>
                --}}


            </div>
        </div>

        {{-- 結果判定画面 --}}
        <div v-bind:class="[isResultMode ? 'resultModeActive' : 'inactiveDiv']" style="border: solid 5px rgb(73, 172, 157); border-radius: 10px; margin: auto; max-width: 60%; padding: 5px; background: white;">
            <div>
                <br>
                <div style=" text-align: center;">
                    <span style="font-size: 36; font-weight: bold;">得点：(% score_string %)</span>
                </div>
                <br><br>

                <table>
                    <tr>
                        <th>
                            問題番号
                        </th>
                        <th>
                            問題文
                        </th>
                        <th>
                            正誤
                        </th>

                    </tr>

                    <template v-for="item in arrayResult">
                        <tr>
                            <td>
                                (% item[0] %)
                            </td>
                            <td style="text-align: left;">
                                (% item[1] %) 
                            </td>
                            <td>
                                (% item[2] %)
                            </td>
                        </tr>
                    </template>
                </table>
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

                // 結果判定モードフラグ
                isResultMode: false,

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
                indexQuestion: 0,           // 問題インデックス

                question_sentence: "",      // 問題文
                hasGraph: false,            // 図表フラグ
                graphFileName: "",          // 図表ファイル名

                required_numOfAnswer: 0,    // 必須回答数
                number_of_answers: 0,       // 正答の数

                choices: [],                // 選択肢配列
                answers: [],                // 正答配列

                isSingleSelect: false,      // 必須回答数が１
                isMultiSelect:  false,      // 必須回答数が複数
                isNoSelect:     false,      // 必須回答数が０

                isSingleAnswer: false,      // 正解の数が１
                isMultiAnswer: false,       // 正解の数が複数
                isNoAnswer: false,          // 正解の数が０

                lastQuestionNumber: 0,      // 最終問題番号

                // 最初の問題ではない
                isNotFirstQuestion: false,

                // 最終問題ではない
                isNotLastQuestion:  true,

                // 最終問題である
                isLastQuestion: false,

                // 選択肢の文字列
                arrayChoiceCharacter: ['ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ'],

                selectedAnswer: 0,

                // ラジオボタン 選択
                radioAnswer: "",

                // チェックボックス 選択
                checkboxAnswer: [],

                // 選択済み回答配列
                arraySelectedChoice: [],

                // 今回正誤配列
                arrayNowCorrects: [],

                // 結果表示用配列
                arrayResult: [],

                score_string: "",
            },

            methods: {
                // 科目グループタブのクリックイベントハンドラ
                onRandomTab: function() {
                    //console.log('ランダム出題タブ 押下');

                    // 登録と一覧表示の、どっちが押下されているかによって、アクティブにするコンテンツが変わるため、条件分岐が必要
                    this.isRandomTabActive      = true;
                    this.isSelectYearTabActive  = false;
                    this.isStatisticsTabActive  =   false;

                },

                onSelectYearTab: function() {
                    //console.log('年度指定タブ 押下');

                    //
                    this.isRandomTabActive      =   false;
                    this.isSelectYearTabActive  =   true;
                    this.isStatisticsTabActive  =   false;
                    
                },

                onStatisticsTab: function() {
                    //console.log('統計情報タブ 押下');

                    this.isRandomTabActive      =   false;
                    this.isSelectYearTabActive  =   false;
                    this.isStatisticsTabActive  =   true;
                },

                onSet10: function() {
                    //console.log('ランダム１０設定');
                    // ランダム出題数 設定
                    this.number_randomQuestion = 10;
                },

                onSet30: function() {
                    //console.log('ランダム３０設定');
                    // ランダム出題数 設定
                    this.number_randomQuestion = 30;
                },

                onSet50: function() {
                    //console.log('ランダム５０設定');
                    // ランダム出題数 設定
                    this.number_randomQuestion = 50;
                },

                onSet100: function() {
                    //console.log('ランダム１００設定');
                    // ランダム出題数 設定
                    this.number_randomQuestion = 100;
                },

                onGetTitleId: function() {
                    // console.log('タイトル取得');

                    this.title_id = $('input[name="title_id"]:checked').val();

                    //console.log('title_id: ' + this.title_id);
                },

                onStartQuestion: function() {

                    //console.log('出題スタート');

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

                    //var url = "http://localhost:8080/excercise_menu/" + reqString;
                    var url = "https://lara-assist.jp/excercise_menu/" + reqString;


                    // APIを投げて、問題文、選択肢文、正答文、回答履歴を取得
                    $.ajax({
                        url :   url,
                        type:   'GET',
                        dataType:   'json',
                    })
                    .done(function(data, textStatus, jqXHR) {
                        //console.log('ajax成功');

                        this.questionInfo = data;

                        this.arrayQuestionSentences = data[0];

                        // 選択肢配列
                        this.arrayChoiceSentences = data[1];

                        // 正答配列
                        this.arrayAnswerSentences = data[2];

                        // 回答履歴配列
                        this.arrayCorrects = data[3];

                        // 最終問題番号
                        this.lastQuestionNumber = data[0].length;

                        //console.log('最終問題番号： ' + this.lastQuestionNumber);

                        // 選択済み回答配列 初期化
                        for(var i=0; i < (this.lastQuestionNumber + 1); i++){
                            this.arraySelectedChoice[i] = "";
                        }

                        // 問題文情報 設定
                        this.question_number =   this.arrayQuestionSentences[0]["question_number"];             // 問題番号
                        this.question_sentence = this.arrayQuestionSentences[0]["question_sentence"];           // 問題文

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

                        this.question_number = 1;
                        this.indexQuestion = 0;

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


                    // 必須回答数が０，１，２で処理分岐

                    if(this.arrayQuestionSentences[this.indexQuestion]['required_numOfAnswers'] == 1){

                    //if(this.isSingleSelect){

                        // 必須回答数が１
                        // 押下されているボタンを取得
                        var selectedChoice = $('input[name="choice"]:checked').val();

                        if(selectedChoice >= 0){
                            // 選択済み回答配列 値格納
                            this.arraySelectedChoice[this.question_number] = this.radioAnswer;
                            //this.arraySelectedChoice[this.question_number] = selectedChoice;
                        } else {
                            this.arraySelectedChoice[this.question_number] = "";
                        }

                        //console.log('前の問題へボタン 押下、選択済み配列へ格納');
                        

                    } else if(this.isMultiSelect){

                        // 選択済み配列へ、選択された回答（の配列）を格納
                        this.arraySelectedChoice[this.question_number] = this.checkboxAnswer;

                        //console.log('checkboxAnswer: ' + this.checkboxAnswer);


                    } else if(this.isNoSelect){

                        // 必須回答数が０
                        this.arraySelectedChoice[question_number] = "";
                    }

                    // 問題番号　１減算
                    this.question_number--;
                    this.indexQuestion = this.question_number - 1;

                    this.radioAnswer = "";
                    this.checkboxAnswer = [];

                    // 次の問題の為の処理

                    // 必須回答数 判定
                    if(this.arrayQuestionSentences[this.indexQuestion]['required_numOfAnswers'] == 1){

                        //console.log('必須回答数が１判定');
                        //console.log('問題番号：' + this.question_number);

                        // 答えが選択済みかどうかを判定
                        if( this.arraySelectedChoice[this.question_number] >= 0) {

                            // ラジオボタンのモデルへ、選択済み回答の値を格納
                            this.radioAnswer = this.arraySelectedChoice[this.question_number];

                        } else {

                            // ラジオボタンのチェックを外す
                            $('input[name="choice"]').prop('checked',false);
                        }

                    } else if(this.arrayQuestionSentences[this.indexQuestion]['required_numOfAnswers'] > 1){

                        // 配列判定
                        if($.isArray(this.arraySelectedChoice[this.question_number]) ){

                        //if(this.arraySelectedChoice[this.question_number].isArray()  ){

                            // チェックボックスのモデルへ、選択された回答を格納
                            this.checkboxAnswer = this.arraySelectedChoice[this.question_number];

                        } else {

                            this.checkboxAnswer = [];
                        }

                    }
                },

                // 『次の問題へ』ボタン押下時の処理
                onNextQuestion: function() {

                    // 選ばれた選択肢の値を取得し、保存

                    // 必須回答数が０，１，２で処理分岐
                    if(this.isSingleSelect){

                        // 必須回答数が１
                        // 押下されているボタンを取得
                        var selectedChoice = $('input[name="choice"]:checked').val();

                        if(selectedChoice >= 0){
                            this.arraySelectedChoice[this.question_number] = selectedChoice;
                        } else {
                            this.arraySelectedChoice[this.question_number] = "";
                        }

                    } else if(this.isMultiSelect){

                        // 選択済み配列へ、選択された回答（の配列）を格納
                        this.arraySelectedChoice[this.question_number] = this.checkboxAnswer;

                    } else if(this.isNoSelect){

                        // 必須回答数が０
                        this.arraySelectedChoice[question_number] = "";
                    }


                    this.question_number++;
                    this.indexQuestion = this.question_number - 1;

                    this.radioAnswer = "";
                    this.checkboxAnswer = [];

                    // 表示させる問題の必須回答数によって、処理を変える必要がある

                    //********************
                    // 次の問題の為の処理
                    //********************
                    if(this.arrayQuestionSentences[this.indexQuestion]['required_numOfAnswers'] == 1){

                        // 答えが選択済みかどうかを判定
                        /*
                        if(this.arraySelectedChoice[this.question_number] !== null
                        && this.arraySelectedChoice[this.question_number] !== "" ){
                            */
                        // 数値かどうかを判定

                        //console.log('チェック変数："' + this.arraySelectedChoice[this.question_number]) + '"';

                        if(this.arraySelectedChoice[this.question_number] >= 0) {

                            // ラジオボタンのモデルへ、選択された回答を格納
                            this.radioAnswer = this.arraySelectedChoice[this.question_number];

                        } else {

                            // ラジオボタンのチェックを外す
                            $('input[name="choice"]').prop('checked',false);
                        }

                    // 必須回答数 判別
                    } else if(this.arrayQuestionSentences[this.indexQuestion]['required_numOfAnswers'] > 1){

                        //console.log('this.arraySelectedChoice[this.question_number]: ' + this.arraySelectedChoice[this.question_number]);

                        if($.isArray(this.arraySelectedChoice[this.question_number])  ){

                        //if(this.arraySelectedChoice[this.question_number].isArray()  ){

                            // チェックボックスのモデルへ、選択された回答を格納
                            this.checkboxAnswer = this.arraySelectedChoice[this.question_number];

                        } else {

                            this.checkboxAnswer = [];
                        }

                    }


                },

                onShowResult: function() {

                    // 最終問題の回答を『選択済み回答配列』へ保存
                    // 選ばれた選択肢の値を取得し、保存

                    // 必須回答数が０，１，２で処理分岐
                    if(this.isSingleSelect){

                        // 必須回答数が１
                        // 押下されているボタンを取得
                        var selectedChoice = $('input[name="choice"]:checked').val();

                        if(selectedChoice >= 0){

                            this.arraySelectedChoice[this.question_number] = selectedChoice;

                        } else {

                            this.arraySelectedChoice[this.question_number] = "";
                        }

                    } else if(this.isMultiSelect){

                        // 選択済み配列へ、選択された回答（の配列）を格納
                        this.arraySelectedChoice[this.question_number] = this.checkboxAnswer;

                    } else if(this.isNoSelect){

                        // 必須回答数が０
                        this.arraySelectedChoice[question_number] = "";
                    }

                    // 出題モード解除
                    this.isQuestionMode = false;

                    // 結果出力モード オン
                    this.isResultMode = true;

                    // 選択済み配列をもとに、正答配列と比較して個別に採点、採点配列へ格納
                    // 採点処理の配列を、結果表示用配列へ格納

                    // 得点 初期化
                    var score = 0;

                    // 算定対象問題数
                    var bunbo = this.lastQuestionNumber;

                    var hissu;
                    var checkAnswer;
                    var seikai;

                    for(var indexQ = 0; indexQ < this.lastQuestionNumber; indexQ++){

                        hissu = 0;
                        checkAnswer = "";
                        var indexQPlus1 = indexQ + 1;

                        seikai = this.arrayAnswerSentences[indexQ];

                        console.log('正解の要素数：' + seikai.length);

                        if(seikai.length == 0){
                            seikai = "";
                        } else if(seikai.length == 1){

                            seikai = seikai[0]['answer_sentence'];

                        } else if(seikai.length > 1){

                            var work_array = [];
                            var index_work_array = 0;

                            for(var i = 0; i < seikai.length; i++){
                                if( seikai[i]['answer_sentence'] !== ""
                                &&  seikai[i]['answer_sentence'] !== null
                                &&  !(isNaN(seikai[i]['answer_sentence'])) ){
                                    work_array[index_work_array] = seikai[i]['answer_sentence'];
                                    index_work_array++;
                                }
                            }

                            seikai  = work_array;
                        }

                        // 連想配列を取得しているだけで、すぐ利用できる形式になっていない
                        console.log('seikai：' + seikai);
                        //console.log('seikaiの要素数：' + seikai.length);

                        console.log('問題番号：' + indexQPlus1 + ", 正解： " + seikai);

                        //seikai['answer_id']
                        //seikai['answer_sentence']

                        //console.log("seikai[0]['answer_id']: " + seikai[0]['answer_id']);
                        //console.log("seikai[0]['answer_sentence']: " + seikai[0]['answer_sentence']);
/*
                        console.log("seikai[1]['answer_id']: " + seikai[1]['answer_id']);
                        console.log("seikai[1]['answer_sentence']: " + seikai[1]['answer_sentence']);

                        console.log("seikai[2]['answer_id']: " + seikai[2]['answer_id']);
                        console.log("seikai[2]['answer_sentence']: " + seikai[2]['answer_sentence']);
*/

                        // 必須回答数 取得
                        hissu = this.arrayQuestionSentences[indexQ]["required_numOfAnswers"];

                        // 正解の数 取得
                        seikaisu = this.arrayQuestionSentences[indexQ]["number_of_answers"];

                        // 正解配列

                        // 必須回答数 判別
                        if(hissu == 0){

                            // 必須回答数 ０
                            bunbo--;

                        } else if(hissu == 1){

                            // 必須回答数 １
                            checkAnswer = this.arraySelectedChoice[indexQPlus1];

                            // 正解の数 判定
                            if(seikaisu == 0){

                                bunbo--;

                                // 今回正誤配列 格納
                                this.arrayNowCorrects[indexQ] = "-";

                            } else if(seikaisu == 1) {

                                console.log('checkAnswer, seikai: ' + checkAnswer + ', ' + seikai);

                                // **********
                                if((Number(checkAnswer) + 1) == seikai
                                && checkAnswer != "" ){

                                    // 得点加算
                                    score++;

                                    // 今回正誤配列 格納
                                    this.arrayNowCorrects[indexQ] = "〇";

                                } else {

                                    // 今回正誤配列 格納
                                    this.arrayNowCorrects[indexQ] = "×";
                                }
                            } else if(seikaisu > 1) {

                                console.log('seikai: ' + seikai);
                                console.log('seikai[0]: ' + seikai[0]);
                                console.log('seikai[1]: ' + seikai[1]);


                                console.log('checkAnswer: ' + checkAnswer);

                                // **********
                                if(seikai.includes((Number(checkAnswer) + 1))
                                &&  checkAnswer != "" ){

                                    // 得点加算
                                    score++;

                                    // 今回正誤配列 格納
                                    this.arrayNowCorrects[indexQ] = "〇";

                                } else {

                                    // 今回正誤配列 格納
                                    this.arrayNowCorrects[indexQ] = "×";

                                }

                            }

                        } else if(hissu > 1){

                            // 必須回答数 複数
                            checkAnswer = this.arraySelectedChoice[indexQPlus1];

                            // 正解の数 判定
                            if(seikaisu == 0){

                                bunbo--;

                                // 今回正誤配列 格納
                                this.arrayNowCorrects[indexQ] = "-";

                            } else if(seikaisu == 1) {

                                // 今回正誤配列 格納
                                this.arrayNowCorrects[indexQ] = "-";

                            } else if(seikaisu > 1){

                                console.log('必須も正解数も複数');

                                var number_correct = 0;

                                // checkAnswer複数、seikai は配列。
                                // 選んだもの全てが正解かつ、必須回答数の分だけ選んでいる、が正解の条件
                                for(i = 0; i < checkAnswer.length; i++){

                                    // **********
                                    if(seikai.includes((Number(checkAnswer[i]) + 1))
                                    &&  checkAnswer[i] != "" ){
                                        number_correct++;
                                    }

                                }

                                // 正解判定（必須回答数と同じ数だけ選択している、正解だった数が必須回答数と一致している）
                                if( number_correct == hissu
                                &&  i == hissu){

                                    // 得点加算
                                    score++;

                                    // 今回正誤配列 格納
                                    this.arrayNowCorrects[indexQ] = "〇";

                                } else {
                                    // 今回正誤配列 格納
                                    this.arrayNowCorrects[indexQ] = "×";
                                }

                            }
                        }

                    }
                    

                    // 結果表示用配列 作成

                    for(index = 0; index < this.lastQuestionNumber; index++){

                        indexPlus1 = index + 1;

                        this.arrayResult[index] = [
                            indexPlus1, 
                            this.arrayQuestionSentences[index]['question_sentence'],
                            this.arrayNowCorrects[index]
                        ];

                        //console.log('結果の２番目：' + this.arrayQuestionSentences[index]['question_sentence']);
                    }

                    // 合計得点計算
                    /*
                    score;
                    bunbo;
                    */
                    var score_percent = Math.round(score / bunbo * 100 * (Math.pow( 10, 2 ) ) ) / Math.pow( 10, 2 );

                    this.score_string = score_percent + "％" + "(" + score + "/" + bunbo + ")";

                    // ログイン判定
                    // ajax でLaravel 側に処理を任せる
                    // レコードへ登録する項目はユーザID、科目ID、タイトルID、試験回数、試験得点。Laravel 側ではユーザID、試験回数は取得可能。
                    // ユーザID、科目ID{{ $subject_name }}、タイトルIDは選択されたタイトルIDをJQueryで取得、試験得点（this.score_string）
                    
                    var postString = [];

                    var titleId     =   $('input[name="title_id"]:checked').val();

                    postString[0]   =   {{ $subject_id }};     // 科目ID
                    postString[1]   =   titleId;               // タイトルID
                    postString[2]   =   this.score_string;     // 得点


                    var url = "/post_result";

                    // APIを投げて、ログイン判定・ログインしているなら試験得点などをレコード登録。非ログインなら処理なし
                    $.ajax({
                        url :           url,
                        type:           'POST',
                        data:           { val: postString },
                        dataType:       'json',
                    })
                    .done(function(data, textStatus, jqXHR) {
                        //console.log('ajax成功');

                    }.bind(this))
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log('ajax失敗');
                        console.log('jqXHR: ' + jqXHR);
                        console.log('textStatus: ' + textStatus);
                        console.log('errorThrown: ' + errorThrown);
                        this.isError = true;
                        this.message = 'テスト結果の保存に失敗しました。';
                    }.bind(this));




                },
            },

            watch: {
                question_number: function (new_question_number, old_question_number){

                    var indexQuestionNumber = new_question_number - 1;
                    var selectedAnswer;

                    // 問題文 更新
                    //this.question_number =   this.arrayQuestionSentences[0]["question_number"];                                  // 問題番号
                    this.question_sentence      = this.arrayQuestionSentences[indexQuestionNumber]["question_sentence"];           // 問題文
                    this.required_numOfAnser    = this.arrayQuestionSentences[indexQuestionNumber]["required_numOfAnswers"];       // 必須回答数

                    this.selectedAnswer         =   this.arraySelectedChoice[new_question_number];

                    console.log('画像フラグ：' + this.arrayQuestionSentences[indexQuestionNumber]["flag_graph_exists"]);

                    // 画像有無フラグ 判定
                    if(this.arrayQuestionSentences[indexQuestionNumber]["flag_graph_exists"] == "0"){


                        this.hasGraph = false;


                    } else if(this.arrayQuestionSentences[indexQuestionNumber]["flag_graph_exists"] == "1"){

                        //
                        this.hasGraph = true;

                        // 
                        this.graphFileName = "/image/fe/" + this.arrayQuestionSentences[indexQuestionNumber]["image_filename"];

                        console.log('問題番号：' + new_question_number);
                        console.log('図表フラグ：' + this.arrayQuestionSentences[indexQuestionNumber]["flag_graph_exists"]);
                        console.log('ファイル名：' + this.graphFileName + "\n\n");
                    }




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
                    
                    this.numberOfAnsers = this.arrayQuestionSentences[indexQuestionNumber]["number_of_answers"];     // 正解の数

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

                    this.choices = this.arrayChoiceSentences[indexQuestionNumber];                                          // 選択肢配列
                    this.answers = this.arrayAnswerSentences[indexQuestionNumber];                                          // 正答配列

                    //console.log('this.choices: ' + this.choices);
                    //console.log('this.answers: ' + this.answers);


                    // 最初の問題番号判定
                    if(this.question_number != 1){
                        this.isNotFirstQuestion = true;
                    } else {
                        this.isNotFirstQuestion = false;
                    }

                    if(this.question_number == this.lastQuestionNumber){
                        this.isLastQuestion = true;
                        this.isNotLastQuestion = false;

                    } else {

                        this.isLastQuestion    = false;
                        this.isNotLastQuestion = true;
                    }

                },

                question_sentence: function(new_question_sentence, old_question_sentence){

                }
            },


        })
    </script>
@endsection