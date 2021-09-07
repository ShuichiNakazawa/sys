@extends('layouts.app_carhythm')

@section('content')

    <br>
    <div style="width: 100%; margin: 0 auto;">
        <div>
            <h4>
                メッセージ
            </h4>
        </div>

        <div>
            <h4>
                所属ライバー
            </h4>
        </div>

        <div>
            <h4>
                提携ライバー
            </h4>
        </div>

        <div>
            <h4>
                会社概要
            </h4>
        </div>
    </div>





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
                hasGrapgh: false,           // 図表フラグ

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
                    
                    // 次の問題の為の処理
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

                    var score_percent = Math.round(score / bunbo * 100 * (Math.pow( 10, 2 ) ) ) / Math.pow( 10, 2 );

                    this.score_string = score_percent + "％" + "(" + score + "/" + bunbo + ")";


                },
            },

            watch: {
                question_number: function (new_question_number, old_question_number){

                    var indexQuestionNumber = new_question_number - 1;
                    var selectedAnswer;

                    // 問題文 更新
                    //this.question_number =   this.arrayQuestionSentences[0]["question_number"];                               // 問題番号
                    this.question_sentence      = this.arrayQuestionSentences[indexQuestionNumber]["question_sentence"];           // 問題文
                    this.required_numOfAnser    = this.arrayQuestionSentences[indexQuestionNumber]["required_numOfAnswers"];       // 必須回答数

                    this.selectedAnswer         =   this.arraySelectedChoice[new_question_number];



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