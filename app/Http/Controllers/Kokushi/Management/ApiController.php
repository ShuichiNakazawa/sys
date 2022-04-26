<?php

namespace App\Http\Controllers\Kokushi\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;        
use App\Subject_group;                          // 科目グループテーブル モデル
use App\Subject;                                // 科目テーブル モデル
use App\Title;                                  // 問題タイトルテーブル モデル
use App\Question_sentence;                      // 問題文テーブル モデル
use App\Choice_sentence;                        // 選択肢文テーブル モデル
use App\Answer_sentence;                        // 正答テーブル モデル

use Validator;
use Carbon\Carbon;



class ApiController extends Controller
{
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    // 機能名：科目グループ 取得
    // 概要：　科目グループテーブルからレコードを全件取得する。
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function GetSubjectGroups(){

        //科目グループ一覧 取得
        // 科目リスト 取得
        $subject_groups =	Subject_group::orderby('id', "ASC")
                                            ->get();

        //jsonエンコード
        $result         =   json_encode($subject_groups);

        // 戻り値
        return $result;

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    // 機能名：科目 取得
    // 概要：　入力された科目グループコードを元に、科目テーブルからレコードを全件取得する。
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function GetSubjects($subject_group_id){

        // 変数宣言
        $result = [];

        //科目一覧 取得
        if($subject_group_id === 0){

            // 科目グループIDに０が指定されている場合は、全科目グループから検索
            /*
            $subjects       =   Subject::orderby('id', "ASC")
                                            ->get();
                                            */

            $subjects       =   Subject::get();

        } else {

            $subjects       =   Subject::where('subject_group_id', '=', $subject_group_id)
                                            ->orderby('id', "ASC")
                                            ->get();
        }

        $result[0] = 0;
        $result[1] = $subjects;
        $result[2] = $subject_group_id;

        //jsonエンコード
        $result         =   json_encode($result);

        // 戻り値
        return $result;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    // 機能名：問題タイトル 取得
    // 概要：　入力された科目コードを元に、問題タイトルテーブルからレコードを全件取得する。
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function GetTitles($subject_id){

        //dd($subject_group_id);

        //科目一覧 取得
        $titles       =   Title::where('subject_id', '=', $subject_id)
                                        ->orderby('title_id', "DESC")
                                        ->get();

        // try catch で、DBエラーを拾う

        //jsonエンコード
        $result[0]          =   0;
        $result[1]         =   json_encode($titles);

        $res = json_encode($result);

        // 戻り値
        return $res;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    // 機能名：問題タイトル 登録
    // 概要：　入力された科目コード・タイトル名を元に、問題タイトルテーブルへレコードを登録する。
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function StoreTitle(Request $request){

        $subject_id             =   $request->input('subject_id');              // 科目ID
        $question_title         =   $request->input('title_name');              // 問題タイトル

        // タイトルID最大値 取得
        $maxTitleId             =   Title::where('subject_id', $subject_id)
                                        ->orderby('title_id', 'DESC')
                                        ->value('title_id');


        $newTitleId             =   $maxTitleId + 1;

        // タイトル登録
        $title_record                   =   new Title();
        $title_record->subject_id       =   $subject_id;
        $title_record->title_id         =   $newTitleId;
        $title_record->question_title   =   $question_title;
        $title_record->sight_key        =   "origin";
        $title_record->created_at       =   new Carbon('now');
        $title_record->updated_at       =   new Carbon('now');

        // レコード登録
        $title_record->save();

        $result[0]  =   0;

        // 処理終了
        return $result;

    }

    
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    // 機能名：問題文 取得
    // 概要：　入力された科目コード、タイトルID、問題番号を元に、問題文テーブルからレコードを１件取得する。
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function GetQuestionSentences($subject_id, $title_id, $question_number){
        
        //問題文 取得
        $question_sentence   =   Question_sentence::select('question_sentence')
                                                    ->where('subject_id', '=', $subject_id)
                                                    ->where('title_id', '=', $title_id)
                                                    ->where('question_number', '=', $question_number)
                                                    ->value('question_sentence');

        //json エンコード
        $result         =   json_encode($question_sentence);

        // 戻り値
        return $result;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    // 機能名：問題文 登録
    // 概要：　入力された問題文の情報を元に、問題文テーブル（１件）、選択肢テーブル（複数件）、正答テーブル（複数件）へレコードを追加する。
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function storeQuestionSentence(Request $request){

        //dd($request);

        // 終了コード
        $ret_code   =   [];

        // エラー判定
        $error_code = 0;

        $test_message = "";

        $test_val = "";

        $test_val0 = "";


        // バリデーション
        $validator = Validator::make($request->all(),
        [
            'subject_id'            =>  'required | numeric',     // 科目ID
            'title_id'              =>  'required | numeric',     // タイトルID
            'question_number'       =>  'required | numeric | between:0,200',     // 問題番号
            'number_of_choice'      =>  'required | numeric | between:3,9',     // 選択肢の数
            'number_of_need_select' =>  'required | numeric | between:0,5',     // 必須回答数
            'number_of_answer'      =>  'required | numeric | between:0,5',     // 正答の数
            'question_sentence'     =>  '',     // 問題文
            'flag_graph_exists'     =>  'required | numeric | between:0,3',     // 図表の生む
//            'array_choice_sentence'           // 選択肢文配列
//            'array_answer_sentence'           // 正答文配列
        ]);

        $subject_id             =   $request->input('subject_id');
        $title_id               =   $request->input('title_id');
        $question_number        =   $request->input('question_number');
        $question_sentence      =   $request->input('question_sentence');
        $flag_graph_exists      =   $request->input('flag_graph_exists');
        $image_filename         =   $request->input('image_filename');
        $required_numOfAnswers  =   $request->input('number_of_need_select');
        $number_of_choices      =   $request->input('number_of_choice');
        $number_of_answers      =   $request->input('number_of_answer');
        $sight_key              =   "origin";

        $test_val0 =    "subject_id:" . $request->input('subject_id') . "\n"
                    .   "title_id:"   . $request->input('title_id')    .   "\n"
                    .   "question_number:"  . $request->input('question_number') . "\n"
                    .   "number_of_choice:" . $request->input('number_of_choice') . "\n"
                    .   "number_of_need_select:" . $request->input('number_of_need_select') . "\n"
                    .   "number_of_answer:" .   $request->input('number_of_answer') . "\n"
                    .   "question_sentence:" . $request->input('question_sentence') . "\n"
                    .   "flag_graph_exists:" . $request->input('flag_graph_exists');


        // バリデーションチェック
        if($validator->fails()){
            $message    =   '入力値に問題あり';
            $error_code =   1;

            $ret_code[0] = 1;
            $ret_code[1] = $message;
            return json_encode($ret_code);
            exit();

        } else {
            $message    =   '入力値に問題なし';
        }


        // 選択肢の数
        $number_of_choice   =   (int)$request['number_of_choice'];

        // 正答の数
        $number_of_answer   =   (int)$request['number_of_answer'];


        // 選択肢配列 取得
        $array_choice_sentence = explode(',', $request->input('array_choice_sentence'));

        $test_val2 = $request->input('array_choice_sentence');

        /* test_val3 は、先頭に空の配列要素が入ってしまっている */
        $test_val3 = $array_choice_sentence;


        // 選択肢
        for($i=0; $i<$number_of_choice; $i++){

            // 選択肢配列から１件取得
            $work_choice_sentence = $test_val3[$i];

            $test_val .= "\n選択肢文: " . $work_choice_sentence;

            // 空白チェック
            if(empty($work_choice_sentence)){
                $message .= "\n選択肢文に空白の項目があります。";
                $error_code =   2;
                $test_message .= "\n選択肢文に空白の項目があります。";
            }
        }

        // エラー判定
        if($error_code === 0){

            // 選択肢文テーブル 登録処理
            // bulk insert のためのSQL文編集

            // 科目、タイトル、choice_id、choice_sentence、sight_key、created_at、updated_at
            $params = [];

            for ($i=0; $i < $number_of_choice; $i++){
                $params[] = [
                    'subject_id'        =>  $subject_id,
                    'title_id'          =>  $title_id,
                    'question_number'   =>  $question_number,
                    'choice_id'         =>  $i,
                    'choice_sentence'   =>  $test_val3[$i],
                    'sight_key'         =>  $sight_key,
                    'created_at'        =>  new Carbon('now'),
                    'updated_at'        =>  new Carbon('now'),
                ];
            }

            Choice_sentence::insert($params);

            /* テスト用 */
/*
            $ret_code[0] = 0;
            $ret_code[1] = "選択肢文テーブル 登録後 終了";
            $ret_code[2] = $test_message;
            $ret_code[3] = $test_val . "\n";
            $ret_code[4] = "number_of_choice: " . $number_of_choice;
            $ret_code[5] = $test_val0;
            $ret_code[6] = "\ntest_val2: " . $test_val2 . "\ntest_val3: ";
            $ret_code[7] = $test_val3;
    
            return json_encode($ret_code);
            exit();
*/

        } else {

            // エラー終了
            $ret_code[0] = 1;
            $ret_code[1] = $message;
            $ret_code[2] = $test_message;
            return json_encode($ret_code);
            exit();

        }


        // 正答文配列 取得
        //$array_answer_sentence = explode(',', $request['array_answer_sentence']);
        $array_answer_sentence = explode(',', $request->input('array_answer_sentence'));


        // 正答文
        for($i=0; $i<$number_of_answer; $i++){
            $work_answer_sentence = $array_answer_sentence[$i];

            // 空白チェック
            if(empty($work_answer_sentence)){
                $message .= "\n正答文に空白の項目があります。";
                $error_code =   3;
                $test_message .= "\n正答文に空白の項目があります。";
            }
        }

        // エラーによる終了判定。結果コードなどを整理して修正する必要がある。
        if($error_code === 0){

            // 正答文テーブル 登録処理
            // 科目、タイトル、choice_id、choice_sentence、sight_key、created_at、updated_at
            $params = [];

            for ($i=0; $i < $number_of_answer; $i++){
                $params[] = [
                    'subject_id'        =>  $subject_id,
                    'title_id'          =>  $title_id,
                    'question_number'   =>  $question_number,
                    'answer_id'         =>  $i,
                    'answer_sentence'   =>  $array_answer_sentence[$i],
                    'sight_key'         =>  $sight_key,
                    'created_at'        =>  new Carbon('now'),
                    'updated_at'        =>  new Carbon('now'),
                ];
            }

            // テーブル登録処理
            Answer_sentence::insert($params);

        } else {

            // エラー処理
            $ret_code[0] = 1;
            $ret_code[1] = $message;
            $ret_code[2] = $test_message;
            return json_encode($ret_code);
            exit();
        }

/*
        $ret_code[0] = 0;
        $ret_code[1] = "DB登録前で終了";
        $ret_code[2] = $test_message;
        $ret_code[3] = $test_val . "\n";
        $ret_code[4] = "number_of_choice: " . $number_of_choice;
        $ret_code[5] = $test_val0;
        $ret_code[6] = "\ntest_val2: " . $test_val2 . "\ntest_val3: ";
        $ret_code[7] = $test_val3;

        return json_encode($ret_code);
        exit();
*/

        // 問題文テーブル 空インスタンス作成 
        $question_sentence_record = new Question_sentence();

        // 問題文レコード 編集
        $question_sentence_record->subject_id               =   $subject_id;                // 科目ID
        $question_sentence_record->title_id                 =   $title_id;                  // タイトルID
        $question_sentence_record->question_number          =   $question_number;           // 問題番号
        $question_sentence_record->question_sentence        =   $question_sentence;         // 問題文
        $question_sentence_record->flag_graph_exists        =   $flag_graph_exists;         // 画像有無
        $question_sentence_record->image_filename           =   $image_filename;            // 画像ファイル名
        $question_sentence_record->required_numOfAnswers    =   $required_numOfAnswers;     // 必須回答数
        $question_sentence_record->number_of_choices        =   $number_of_choices;         // 選択肢の数
        $question_sentence_record->number_of_answers        =   $number_of_answers;         // 正答の数
        $question_sentence_record->sight_key                =   $sight_key;                 // サイトキー
        $question_sentence_record->created_at               =   new Carbon('now');          // 作成日時
        $question_sentence_record->updated_at               =   new Carbon('now');          // 更新日時

        // バリデーション

        // 問題文テーブル レコード登録
        $question_sentence_record->save();

        $ret_code[0] = 0;
        $ret_code[1] = "DB登録後に終了";
        $ret_code[2] = $test_message;
        $ret_code[3] = $test_val . "\n";
        $ret_code[4] = "number_of_choice: " . $number_of_choice;
        $ret_code[5] = $test_val0;
        $ret_code[6] = "\ntest_val2: " . $test_val2 . "\ntest_val3: ";
        $ret_code[7] = $test_val3;

        return json_encode($ret_code);
        exit();

        /* SQLを１回発行か選択肢の数だけ発行するのかで記述が変わる。１回発行のほうが理想。その場合、SQL文を工夫する。★バルクインサート★ */
        // バルクインサートのためのSQL文を考えて記述する。
        // 選択肢文は複数存在する。ループで囲む
        /*
        // 選択肢１～９ 取得
        for($i=0; $i<$number_of_choice; $i++){
            $array_choice_sentence[$i]
        }
        */

        // 選択肢文テーブル レコード登録
        $choice_sentence_record = new Choice_sentence();

        // 選択肢文テーブル レコード編集
        $choice_sentence_record->subject_id         =   $subject_id;            // 科目ID
        $choice_sentence_record->title_id           =   $title_id;              // タイトルID
        $choice_sentence_record->question_number    =   $question_number;       // 問題番号
        $choice_sentence_record->choice_id          =   $choice_id;             // 選択肢ID
        $choice_sentence_record->choice_sentence    =   $choice_sentence;       // 選択肢文
        $choice_sentence_record->sight_key          =   $sight_key;             // サイトキー
        $choice_sentence_record->created_at         =   new Carbon('now');      // 作成日時
        $choice_sentence_record->updated_at         =   new Carbon('now');      // 更新日時

        // 選択肢文テーブル レコード登録
        $choice_sentence_record->save();

        /* 正答文は複数存在する可能性がある。ループで囲む */
        /*
        // 正答１～５ 取得
        for($i=0; $i<$number_of_answer; $i++){
            $array_answer_sentence[$i]
        }
        */

        // 正答文テーブル レコード作成
        $answer_sentence_record =   new Answer_sentence();

        // 正答文テーブル レコード編集
        $answer_sentence_record->subject_id         =   $subject_id;            // 科目ID
        $answer_sentence_record->title_id           =   $title_id;              // タイトルID
        $answer_sentence_record->question_number    =   $question_number;       // 問題番号
        $answer_sentence_record->answer_id          =   $answer_id;             // 正答ID
        $answer_sentence_record->answer_sentence    =   $answer_sentence;       // 正答文
        $answer_sentence_record->sight_key          =   $sight_key;             // サイトキー
        $answer_sentence_record->created_at         =   new Carbon('now');      // 作成日時
        $answer_sentence_record->updated_at         =   new Carbon('now');      // 更新日時

        // 正答文テーブル レコード登録
        $answer_sentence_record->save();

        $array_answer_sentence  =   $request[9];    // 正答１～５


/*
        // パラメータ受取確認用テスト
        $result = [
                        $subject_id
                    ,   $title_id
                    ,   $question_number
                    ,   $number_of_choice
                    ,   $number_of_need_select
                    ,   $number_of_answer
                    ,   $question_sentence
        ];
*/

        return $result;

    }
}
