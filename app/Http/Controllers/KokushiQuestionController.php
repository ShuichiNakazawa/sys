<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject_names;
use App\Fields;
use App\Question_titles;
use App\Question_sentences;
use App\Question_sentence;
use App\Choice_sentences;
use App\Answer_sentences;
use App\Individual_score;
use App\T_choices;
use App\T_answers;
use App\Subject_group;
use App\Test_score;
use App\Temp_user;
use App\User;

use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

use App\Common\subjectClass;

class KokushiQuestionController extends Controller
{

    // インデックス画面表示前処理
    public function before_kokushi() {

      // 科目グループテーブル 取得
      // 各科目グループごとに科目名を取得したい
      $subject_groups = Subject_group::get();
      $subject_groups_pluck = Subject_group::pluck('id', 'subject_group_name');

      $All_subjects = array();

      $count = 0;

      foreach ($subject_groups as $subject_group){

        // 科目リスト 取得
        $subjects = Subject_names::where('subject_group_id', '=', $subject_group->id)
                                        ->pluck('subject_name', 'id');

        $All_subjects[$count] = $subjects;
        $count++;
      }

      //dd($fields, $All_subjects, $fields_pluck);

      return view('kokushi.index')
              ->with([
                  'subject_groups'    =>  $subject_groups,
                  'subjects'  =>  $All_subjects,
              ]);
    }

    public function showMenu($subject_id) {

      $subject_name_kanji   =  subjectClass::getKanjiName($subject_id);

      $titles = Question_titles::where('subject_name_id', '=', $subject_id)
                                      ->orderby('title_id', 'desc')
                                      ->get();

      // ログイン判定
      if(null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.menu')
      //return view('kokushi.menu', (['kokushi', $subject_id]))
              ->with([
                'subject_id'      =>    $subject_id,
                'subject_name'    =>    $subject_name_kanji,
                'titles'          =>    $titles,
                'logind'          =>    $logind,
              ]);
    }

    // 出題形式設定
    public function setQuestion($subject_id, Request $request) {
      $subject_id		      =	  $request->subject_id;               // 科目ID
      $question_title     =   $request->question_title;           // タイトル名
      $question_title_id  =   $request->title_id;                 // タイトルID

      //dd($question_title_id);

      /*
      $question_title_id	= Question_titles::select('title_id')
                                      ->where('subject_name_id', '=', $subject_id)
                                      ->where('question_title', '=', $question_title)
                                      ->where('sight_key', '=', 'origin')
                                      ->value('title_id');
      */

      //dd($subject_id, $title_id);

      // 問題文 取得
      $question_sentence        =       Question_sentences::where('subject_id', '=', $subject_id)
                                                ->where('question_title_id', '=', $question_title_id)
                                                ->where('question_number', '=', 1)
                                                ->first();

      //dd($question_sentence);

      // 最終問題番号 取得 （下のコメントを流用）
      $question_last_number     =       Question_sentences::select('question_number')
                                                        ->where('subject_id', '=', $subject_id)
                                                        ->where('question_title_id', '=', $question_title_id)
                                                        ->orderby('question_number', 'desc')
                                                        ->limit(1)
                                                        ->value('question_number');

      // 選択肢ボタンの文字配列 設定
      $choice_characters        =       [
                                                'ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ',
                                        ];

      // 選択肢 取得
      $choice_sentences         =       Choice_sentences::where('subject_name_id', '=', $subject_id)
                                                ->where('question_title_id', '=', $question_title_id)
                                                ->where('question_number', '=', 1)
                                                ->get();

      // 科目略称 設定
      $subject_short_name       =       subjectClass::getShortName($subject_id);

      //dd($question_sentence);

      /**
      * ユーザ情報 登録
      **/
      /*    ユーザ情報へランダムな６４桁の数字を併せて持たせる事で、セキュリティを高めようとしていた。
      // ランダムな６４文字を生成
      $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
      $r_str = null;
      for ($i = 0; $i < 64; $i++) {
          $r_str .= $str[rand(0, count($str) - 1)];
      }
      */

      /******************************************
       * 端末保存情報　取得
       *****************************************/
      // ローカルストレージ　値参照
      $user_type_session    = $request->session()->get('user_type');
      $user_id_session      = $request->session()->get('ui');
      $number_test_session  = $request->session()->get('number_test');

      //ok dd($user_type_session, $user_id_session, $number_test_session);

      // ユーザタイプ　存在判定
      if(null === $user_type_session){
        /********************************
         * ユーザータイプ未設定の場合
         ********************************/
        // セッション『ユーザタイプ』へ”仮ユーザ”を保存
        $request->session()->put('user_type', "temp_user");

        $user_type  = 'temp_user';          // ユーザタイプ　設定

        // 仮ユーザーテーブル　件数取得
        $count_temp_user  = Temp_user::count();

        //dd($user_type_session, $user_id_session);

        // 仮ユーザーテーブル　件数判定
        if($count_temp_user == 0){

          //
          //$temp_user_id_db  = 1;

          // 仮ユーザ　新規レコード編集
          $temp_user_obj  = new Temp_user();
          $temp_user_obj->id            = 1;
          $temp_user_obj->user_name     = "guest";
          $temp_user_obj->created_at    = new Carbon('now');
          //$temp_user_obj->updated_at    = '';

          // レコード　追加
          $temp_user_obj->save();

          // セッション『ユーザID』へ”仮ユーザID”を保存
          $request->session()->put('ui', 1);

        } else {
          // セッション『ユーザID』へ”仮ユーザID”を保存
          // ”仮ユーザID”は、仮ユーザテーブルから最大値となるIDを検索し、１加算した値を設定する。
          $temp_user_id_db =  Temp_user::select('id')
                                ->orderby('id', 'desc')
                                ->first()
                                ->value('id');
        }

        // 現在登録中の仮ユーザIDの最大値に１加算
        $temp_user_id_db++;

        // セッション『ユーザID』へ、仮ユーザIDを設定
        $request->session()->put('ui', $temp_user_id_db);
        $user_id  = $temp_user_id_db;

        // セッション『試験回数』　保存
        $request->session()->put('number_test', 1);

      } else {
        /********************************
         * ユーザータイプ設定済
         ********************************/
        // ユーザタイプ　内容判定
        if($user_type_session == "temp_user"){
          /********************************
           * ユーザータイプが仮ユーザの場合
           ********************************/
          // セッション『ユーザID』を取得
          $temp_user_id = $request->session()->get('ui');

          //　ユーザID　登録済チェック（仮ユーザテーブルを検索）
          //　IDによる検索。カウントが良い
          $count_user_id_temp = Temp_user::where('id', '=', $user_id_session)
                                      ->count();

          //OK dd($count_user_id_temp);    // 中身が１なのに新規登録？

          //　該当ユーザ件数　判定
          if($count_user_id_temp == 0){
            /********************************
            //  仮ユーザテーブル　該当IDなし
              ********************************/
            //　テーブル件数　取得
            $count_temp_user  = Temp_user::count();

            if($count_temp_user > 0){
              //　最大ID　取得　　　（仮ユーザーテーブル０件の場合にエラーになる）
              $max_temp_user_id = Temp_user::select('id')
                                          ->orderby('id', 'desc')
                                          //->first()
                                          ->value('id');

              dd($max_temp_user_id);

              // テスト回数　最大値　取得
              $max_number_test  = Individual_score::select('number_test')
                                          ->orderby('number_test', 'desc')
                                          ->first()
                                          ->value('number_test');

              // テスト回数　加算
              $max_number_test++;

              // セッション『試験回数』　保存
              $request->session()->put('number_test', $max_number_test);

              // ここよりも前でエラー dd($max_number_test);

            } else {
              $max_temp_user_id = 0;

              // セッション『試験回数』　保存
              $request->session()->put('number_test', 1);

            }

            //　新規登録ID
            $max_temp_user_id++;

            //　ユーザID　設定
            $request->session()->put('ui', $max_temp_user_id);    // セッション『仮ユーザID』
            $user_id            = $max_temp_user_id;                        // 画面表示用
            $user_type          = 'temp_user';

            //　仮ユーザテーブル　新規レコード登録
            $temp_user              = new Temp_user();                
            $temp_user->id          = $max_temp_user_id;    // ID
            $temp_user->user_name   = 'ゲスト';              // ユーザ名
            $temp_user->created_at  = new Carbon('now');  // 作成日時
            //$temp_user->updated_at  = '';               // 更新日時

            // レコード　追加
            $temp_user->save();


          } elseif($count_user_id_temp == 1) {

            //　仮ユーザテーブル　該当IDあり

            //　試験得点テーブルから『試験回数』を取得
            $number_test  = Individual_score::select('number_judgement')
                                              ->where('user_id', '=', $user_id_session)
                                              ->orderby('number_judgement', 'desc')
                                              ->value('number_judgement');

            

            //　試験回数　１加算
            $number_test++;

            // セッション『試験回数』　削除
            //$request->session()->forget('number_test');

            //　セッション『試験回数』　保存
            $request->session()->put('number_test', $number_test);

            // ユーザID　設定
            $user_id    =  $temp_user_id;
            $user_type  = 'temp_user';

            

          } else {
            //　仮ユーザテーブル　該当ID　複数件あり
            //　好ましい状態ではない。そもそも重複IDが存在することはないはず
            //　同時アクセス・同時登録による重複はありえるか？
            //　実装は後回しだが、新規仮ユーザとして処理する

          }

        } elseif ($user_type_session == "registered_user") {
          /********************************
           * ユーザータイプが登録済ユーザの場合
           ********************************/
          //　ユーザテーブル検索（該当ユーザ存在チェック）
          $count_user_id  = User::where('id', '=', $user_id_session)
                                          ->count();

          //　該当ユーザ件数　判定
          if($count_user_id == 0){

            //　該当ユーザ無し　新規の仮ユーザとして処理
            //　仮ユーザID最大値　取得
            $max_temp_user_id = Temp_user::select('id')
                                        ->orderby('id', 'desc')
                                        ->first()
                                        ->value('id');

            //　ID１加算
            $max_temp_user_id++;

            //　セッション『ユーザID』　保存
            $request->session()->put('ui', $max_temp_user_id);

            //　セッション『試験回数』　保存
            $request->session()->put('number_test', 1);

            // ユーザID　設定
            $user_id  = $max_temp_user_id;

            // ユーザタイプ　設定
            $user_type  = 'temp_user';

          } elseif ($count_user_id == 1){

            //　該当ユーザ　１件
            //  試験回数　取得（試験得点テーブルから）
            $number_test  = Test_scoring::select('number_test')
                                              ->where('id', '=', $user_id_session)
                                              ->value('number_test');

            //　試験回数　１加算
            $number_test++;

            //　セッション『試験回数』　保存
            $request->session()->put('number_test', $number_test);

            $user_id = $user_id_session;
            $user_type = "registered_user";

          } elseif ($count_user_id > 1){

            //　該当ユーザ　複数件存在
            //　ユーザによる意図的なデータ変更だと思われる。エラーとして停止してよい



          }

        } else {

          //　一時ユーザもしくは登録済みユーザ以外が設定されている事はない。
          //　エラーで停止させて良い


        }

      }

      //　セッション『音声タイプ』　保存
      $request->session()->put('soundType', $request->soundType);

      // 正誤履歴データ　件数取得
      $count_correct    =   Individual_score::where('user_id', '=', $user_id)
                                      ->count();

      //dd($count_correct);

      // 正誤履歴データ　取得
      $array_corrects  = Individual_score::where('user_id', '=', $user_id)
                                    ->orderby('created_at', 'desc')
                                    ->limit(5)
                                    ->get();

      $judges  = array();

      $count_judge = 0;

      // 画面表示用　正誤配列へ格納
      foreach($array_corrects as $array_correct){
        //
        $judges[$count_judge] = $array_correct->judgement;

        //
        $count_judge++;
      }

      for($index = 0; $index < (5 - $count_correct); $index++){

        $judges[$count_judge] = '-';

        // 
        $count_judge++;
      }

      //NG  dd($count_correct, $judges, $count_judge);

      /*********************
      * ユーザ名　取得
      **********************/
      // ユーザタイプ　判定
      if($user_type == 'temp_user'){

        // ユーザ名　ユーザテーブルから取得
        $user_name  = User::SELECT('name')
                              ->where('id', '=', $user_id)
                              ->value('name');

      } else if($user_type == 'registered_user'){

        // ユーザ名　仮ユーザテーブルから取得
        $user_name  = Temp_user::SELECT('user_name')
                              ->where('id', '=', $user_id)
                              ->value('user_name');

      } else {

        //
        $user_name = "";
      }

      //dd($request->testType);
/*
      // 個別得点テーブルへ登録されないため、セッション内容を調査
      $a = $request->session()->get('user_type');
      $b = $request->session()->get('ui');
      $c = $request->session()->get('number_test');

      dd($a, $b, $c);
*/
      // テスト形式 判別
      if ($request->testType == 1){
        return redirect('kokushi/' . $subject_id . '/practice_by_question/' . $question_title_id . '/1')
                  ->with([
                        'subject_id'            =>      $subject_id,
                        'question_title_id'     =>      $question_title_id,
                        'question_sentence'     =>      $question_sentence,
                        'choice_sentences'      =>      $choice_sentences,
                        'subject_short_name'    =>      $subject_short_name,
                        'question_last_number'  =>      $question_last_number,
                        'selected_answer'    	  =>    	'99',
                        'choice_characters'     =>      $choice_characters,
                        'user_name'             =>      $user_name,
                        'judges'                =>      $judges,
                  ]);

      } else if ($request->testType == 2){
        return redirect($subject_short_name . '/practice/' . $subject_id . '/' . $question_title_id . '/1')
                  ->with([
                        'subject_id'            =>      $subject_id,
                        'question_sentence'     =>      $question_sentence,
                        'choice_sentences'      =>      $choice_sentences,
                        'subject_short_name'    =>      $subject_short_name,
                        'question_last_number'  =>      $question_last_number,
                        'choice_characters'     =>      $choice_characters,
                        'selected_answer'    	  =>    	'99',
                        'user_name'             =>      $user_name,
                        'judges'                =>      $judges,
                  ]);
      }
  
    }

    /**
     * 音声再生
     */
    public function audio($subject_id){
      //参照するフォルダを指定
      $folder_name	=	'subject_id' . $subject_id;

      return view('kokushi.audio')
              ->with([
                'folder_name'	=>	$folder_name,
              ]);
    }


    // 科目別　音声再生ページ
    public function showAudio($subject_id) {

      // 参照するフォルダを設定
      $folder_name = 'subject_id' . $subject_id;

      return view('kokushi.audio')
                ->with([
                  'folder_name' =>  $folder_name,
                ]);
    }



    /**
     * 試験開始前に、ユーザーによって選択されたモードを取得し、試験の表示形式等を設定
     */
    public function startPractice(Request $request){
      $subject_id		      =	$request->subject_id;               // 科目ID
      $question_title     = $request->question_title;          // タイトル名
      $question_title_id	= Question_titles::select('title_id')
                                      ->where('subject_name_id', '=', $subject_id)
                                      ->where('question_title', '=', $question_title)
                                      ->where('sight_key', '=', 'origin')
                                      ->value('title_id');

      //dd($subject_id, $question_title, $question_title_id);

      // 問題文 取得
      $question_sentence        =       Question_sentences::where('subject_id', '=', $subject_id)
                                                ->where('question_title_id', '=', $question_title_id)
                                                ->where('question_number', '=', 1)
                                                ->first();

      //dd($question_sentence);

      // 最終問題番号 取得 （下のコメントを流用）
      $question_last_number     =       Question_sentences::select('question_number')
                                                        ->where('subject_id', '=', $subject_id)
                                                        ->where('question_title_id', '=', $question_title_id)
                                                        ->orderby('question_number', 'desc')
                                                        ->limit(1)
                                                        ->value('question_number');

      // 選択肢ボタンの文字配列 設定
      $choice_characters        =       [
                                                'ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ',
                                        ];

      // 選択肢 取得
      $choice_sentences         =       Choice_sentences::where('subject_name_id', '=', $subject_id)
                                                ->where('question_title_id', '=', $question_title_id)
                                                ->where('question_number', '=', 1)
                                                ->get();

      // 科目略称 設定
      $subject_short_name   = subjectClass::getShortName($subject_id);

      /**
      * ユーザ情報 登録
      **/
      // ランダムな６４文字を生成
      $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
      $r_str = null;
      for ($i = 0; $i < 64; $i++) {
          $r_str .= $str[rand(0, count($str) - 1)];
      }

      // ローカルストレージへ登録
      

      // ユーザーテーブルへ登録

      // テスト形式 判別
      if ($request->testType == 1){
        return redirect('kokushi/' . $subject_id . '/practice_by_question/' . $question_title_id . '/1')
                  ->with([
                        'subject_id'            =>      $subject_id,
                        'question_title_id'     =>      $question_title_id,
                        'question_sentence'     =>      $question_sentence,
                        'choice_sentences'      =>      $choice_sentences,
                        'subject_short_name'    =>      $subject_short_name,
                        'question_last_number'  =>      $question_last_number,
                        'selected_answer'    	  =>    	'99',
                        'choice_characters'     =>      $choice_characters,
                 ]);

      } else if ($request->testType == 2){
        return redirect($subject_short_name . '/practice/' . $subject_id . '/' . $question_title_id . '/1')
                  ->with([
                        'subject_id'            =>      $subject_id,
                        'question_sentence'     =>      $question_sentence,
                        'choice_sentences'      =>      $choice_sentences,
                        'subject_short_name'    =>      $subject_short_name,
                        'question_last_number'  =>      $question_last_number,
                        'choice_characters'     =>      $choice_characters,
                        'selected_answer'    	  =>    	'99',
                 ]);
      }

    }


    /***
     * 試験形式
     */
    public function practice($subject_id, $title_id, $question_number, Request $request){

      // 押下ボタン 判定
      if ($request->another_question == '次の問題へ'){
	      $question_number += 1;
      } else if ($request->another_question == '前の問題へ'){
	      $question_number -= 1;

//      } else if ($request->another_question == '結果判定'){
	//結果判定処理へ

      }

      // 問題タイトル 取得
      $question_title	=	Question_titles::select('question_title')
					->where('subject_name_id', '=', $subject_id)
					->where('title_id', '=', $title_id)
					->value('question_title');

      // 問題文 取得
      $question_sentence	=	Question_sentences::where('subject_id', '=', $subject_id)
						->where('question_title', '=', $question_title)
						->where('question_number', '=', $question_number)
						->first();

      // 選択肢 取得
      $choice_sentences		=	Choice_sentences::where('subject_name_id', '=', $subject_id)
                                                ->where('question_title', '=', $question_title)
                                                ->where('question_number', '=', $question_number)
                                                ->get();

      // 正答数 取得
      $number_of_answers	=	Answer_sentences::where('subject_name_id', '=', $subject_id)
						->where('question_title', '=', $question_title)
						->where('question_number', '=', $question_number)
						->count();

      // 科目略称 設定
      $subject_short_name   = subjectClass::getShortName($subject_id);

      // 選択肢ボタンの文字配列 設定
      $choice_characters	=	[
						'ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ',
					];

      // 最終問題番号 取得 （下のコメントを流用）
      $question_last_number	=	Question_sentences::select('question_number')
							->where('subject_id', '=', $subject_id)
                                                	->where('question_title', '=', $question_title)
							->orderby('question_number', 'desc')
                                                	->limit(1)
							->value('question_number');

      return view('kokushi.practice')
            		->with([
                    'question_sentence'	=>	$question_sentence,
                    'choice_sentences'	=>	$choice_sentences,
                    'subject_short_name'	=>	$subject_short_name,
                    'question_last_number'	=>	$question_last_number,
                    'choice_characters'	=>	$choice_characters,
                    'number_of_answers'	=>	$number_of_answers,
      ]);

    }


/**
*  一問一答
 **/

    public function practiceByQuestion($subject_id, $title_id, $question_number, Request $request) {

      header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
      header("Pragma: no-cache");

      // 正解判定フラグ 初期化
      $flag_correct = 0;                // 正解フラグ 初期化
      $selected_answer = 99;            // 選択された正答

      /*
      if(null !== Auth::user() ){
        $user_id  = Auth::user()->id;     // ユーザーID
      } else {
        $user_id  = 0;
      }
      */

      // セッション『ユーザタイプ』　取得
      $user_type_session  = $request->session()->get('user_type');

      // セッション『ユーザーID』　取得
      $user_id_session    = $request->session()->get('ui');

      // セッション『判定回数』　取得
      $number_judgement_session = $request->session()->get('number_test');

      // ユーザタイプ　判定
      if($user_type_session == 'temp_user'){

        // 仮ユーザテーブルからユーザ名を取得
        $user_name  = Temp_user::select('user_name')
                                  ->where('id', '=', $user_id_session)
                                  ->first()
                                  ->value('user_name');

      } elseif($user_type_session == 'registered_user') {

        // ユーザテーブルからユーザ名を取得
        $user_name  = User::select('name')
                              ->where('')
                              ->first()
                              ->value('name');
      }

      // 押下ボタン 判定
      if ($request->another_question == '次の問題へ'){
        $question_number += 1;
      } else if ($request->another_question == '前の問題へ'){
        $question_number -= 1;
      } else if ($request->another_question == '結果判定'){
        //結果判定処理へ


      } else if ($request->judge == '判定'){
        $selected_answer  = $request->selected_answer;
        //dd($selected_answer);
      } else {
        // 初回ページ読込み時
      }

      // 科目略称 設定
      $subject_short_name   = subjectClass::getShortName($subject_id);

      //dd($subject_short_name);

      // 必須回答数 取得
      $numOfNeedSelect	=	Question_sentences::select('required_numOfAnswers')
                ->where('subject_id', '=', $subject_id)
                ->where('question_title_id', '=', $title_id)
                ->where('question_number', '=', $question_number)
                ->limit(1)
                ->value('required_numOfAnswers');

      // 問題文 取得
      $question_sentence        =       Question_sentences::where('subject_id', '=', $subject_id)
                                                ->where('question_title_id', '=', $title_id)
                                                ->where('question_number', '=', $question_number)
                                                ->first();

      // 選択肢 取得
      $choice_sentences         =       Choice_sentences::where('subject_name_id', '=', $subject_id)
                                                ->where('question_title_id', '=', $title_id)
                                                ->where('question_number', '=', $question_number)
                                                ->get();

      // 最終問題番号 取得 （下のコメントを流用）
      $question_last_number     =       Question_sentences::select('question_number')
                                                          ->where('subject_id', '=', $subject_id)
                                                          ->where('question_title_id', $title_id)
                                                          ->orderby('question_number', 'desc')
                                                          ->limit(1)
                                                          ->value('question_number');

      // 選択肢ボタンの文字配列 設定
      $choice_characters        =       [
                                                  'ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ',
                                          ];


      // 正答数 取得
      $number_of_answers        =       Answer_sentences::where('subject_name_id', '=', $subject_id)
                                                ->where('question_title_id', '=', $title_id)
                                                ->where('question_number', '=', $question_number)
                                                ->count();

      // 正答テーブル 取得

      //選択された選択肢 配列宣言
      $array_selected_answers	=	array();
      $array_correce_answers = array();

      // セッション情報　取得
      $user_type_session  = $request->session()->get('user_type');
      $user_id_session    = $request->session()->get('ui');

      $soundType          = $request->session()->get('soundType');

      //********************
      // 正誤配列　取得
      //********************

        // 正誤履歴データ　件数取得
        $count_correct    =   Individual_score::where('user_id', '=', $user_id_session)
                                                  ->where('subject_name_id', '=', $subject_id)
                                                  ->where('question_title_id', '=', $title_id)
                                                  ->where('question_number', '=', $question_number)
                                                  ->where('number_judgement', '=', $number_judgement_session)
                                                  ->count();

        //dd($count_correct);

        // 正誤履歴データ　取得
        $array_corrects  = Individual_score::where('user_id', '=', $user_id_session)
                                      ->where('subject_name_id', '=', $subject_id)
                                      ->where('question_title_id', '=', $title_id)
                                      ->where('question_number', '=', $question_number)
                                      //->where('number_judgement', '=', $number_judgement_session)
                                      ->orderby('created_at', 'desc')
                                      ->limit(5)
                                      ->get();

        //dd($user_id_session, $subject_id, $title_id, $question_number, $number_judgement_session);

        $judges  = array();

        $count_judge = 0;

        // 画面表示用　正誤配列へ格納
        foreach($array_corrects as $array_correct){
          //
          $judges[$count_judge] = $array_correct->judgement;

          //
          $count_judge++;
        }

        for($index = 0; $index < (5 - $count_correct); $index++){

          $judges[$count_judge] = '-';

          // 
          $count_judge++;
        }

        //dd($count_correct, $judges, $count_judge);

        /*********************
        * ユーザ名　取得
        **********************/
        // ユーザタイプ　判定
        if($user_type_session == 'temp_user'){

          // ユーザ名　仮ユーザテーブルから取得
          $user_name  = Temp_user::SELECT('user_name')
                                ->where('id', '=', $user_id_session)
                                ->value('user_name');

        } else if($user_type_session == 'registered_user'){

          // ユーザ名　ユーザテーブルから取得
          $user_name  = User::SELECT('name')
                                ->where('id', '=', $user_id_session)
                                ->value('name');

        } else {

          //
          $user_name = "";
        }

        //dd($user_type_session, $user_id_session);

        // 判定回数　取得
        $number_judgement_session = $request->session()->get('number_test');
                                                  



      
/**
 * 判定処理
 */

      if ($request->judge == '判定'){

        // 正答の数 取得
        $numOfAnswers	=	Answer_sentences::where('subject_name_id', '=', $subject_id)
                        ->where('question_title_id', '=', $title_id)
                        ->where('question_number', '=', $question_number)
                        ->count();

        // 必須回答数 判定
        if ($numOfNeedSelect == 1){

          // 正答の数 判定
          if ($numOfAnswers == 1){
            $answer	=	Answer_sentences::select('answer_sentence')
                                                        ->where('subject_name_id', '=', $subject_id)
                                                        ->where('question_title_id', '=', $title_id)
                                                        ->where('question_number', '=', $question_number)
                                                        ->value('answer_sentence');

            $correct_answers = $answer;

            //dd($choice_sentences);

            $true_selected_answer = (int)$selected_answer + 1;
            $true_selected_answer = (string)$true_selected_answer;

            // 正解 判定（単一正答）
            if ($answer == $true_selected_answer){
              // 正解
              $flag_correct = 1;

            } else {
              // 不正解
              $flag_correct = 2;
            }

            //　個別得点　重複レコード件数　取得
            $count_individual = Individual_score::where('user_id', '=', $user_id_session)
                                                  ->where('subject_name_id', '=', $subject_id)
                                                  ->where('question_title_id', '=', $title_id)
                                                  ->where('question_number', '=', $question_number)
                                                  ->where('number_judgement', '=', $number_judgement_session)
                                                  ->count();

            

            // 判定回数　重複判定
            if($count_individual == 0){
              // 個別点数　登録処理
              $individual_score = new Individual_score();
              $individual_score->user_id            = $user_id_session;               // ユーザID
              $individual_score->subject_name_id    = $subject_id;                    // 科目ID
              $individual_score->question_title_id  = $title_id;                      // タイトルID
              $individual_score->question_number    = $question_number;               // 問題番号
              $individual_score->number_judgement   = $number_judgement_session;      // 判定回数
              $individual_score->judgement          = $flag_correct;                  // 正誤フラグ
              $individual_score->sight_key          = 'origin';                       // サイトキー
              $individual_score->created_at         = new Carbon('now');              // 作成日時
              $individual_score->updated_at         = null;                           // 更新日時

              // レコード追加
              $individual_score->save();

            } else if($count_individual > 0){
              // 処理なし
            }



            /*
            // ログイン済みなら個別得点テーブル 登録
            if ( $user_id != 0){
              //KokushiQuestionController::storeScore($user_id, $subject_id, $title_id, $question_number, $flag_correct);
            }
            */

            // 正解としてビューを返す
            return view('kokushi.practice_by_question')
                        ->with([
                              'subject_id'            =>      $subject_id,                // 科目ID
                              'question_sentence'     =>      $question_sentence,         // 問題文
                              'choice_sentences'      =>      $choice_sentences,          // 選択肢文
                              'subject_short_name'    =>      $subject_short_name,        // 科目名略称
                              'question_last_number'  =>      $question_last_number,      // 最終問題番号
                              'choice_characters'     =>      $choice_characters,         // 選択肢文字列
                              'selected_answer'    	  =>    	$selected_answer,           // 選ばれた選択肢
                              'array_sa'              =>      $array_selected_answers,    // 選ばれた選択肢配列
                              'array_ca'              =>      $answer,                    // 正答配列
                              'number_of_need_select'	=>	    $numOfNeedSelect,           // 必須回答数
                              'number_of_answers'     =>      $number_of_answers,         // 正答の数
                              'flag_correct'          =>      $flag_correct,              // 正解フラグ
                              'user_name'             =>      $user_name,                 // ユーザ名
                              'judges'                =>      $judges,                    // 正誤配列
                              'soundType'             =>      $soundType,                 // 正解時音声
                        ]);
            
          } else {

            // 正答の数が複数存在

            // 正答配列 取得
            $answers	=	Answer_sentences::where('subject_name_id', '=', $subject_id)
                                        ->where('question_title_id', '=', $title_id)
                                        ->where('question_number', '=', $question_number)
                                        ->pluck('answer_sentence')
                                        ->toArray();

            $true_selected_answer = (int)$selected_answer;
            $true_selected_answer = (string)$true_selected_answer;

            // 正解判定
            if (in_array($true_selected_answer, $answers, true)){
              // 正解
              $flag_correct = 1;
            } else {
              // 不正解
              $flag_correct = 2;
            }

            //dd(Auth::user()->id);

            // 個別点数　登録処理
            $individual_score                     = new Individual_score();
            $individual_score->user_id            = $user_id;                   // ユーザID
            $individual_score->subject_name_id    = $subject_id;                // 科目ID
            $individual_score->question_title_id  = $title_id;                  // タイトルID
            $individual_score->question_number    = $question_number;           // 問題番号
            $individual_score->number_judgement   = '';                         // 判定回数
            $individual_score->judge              = $flag_correct;              // 正誤フラグ
            $individual_score->sight_key          = 'origin';                   // サイトキー
            $individual_score->created_at         = new Carbon('now');          // 作成日時
            $individual_score->updated_at         = null;                       // 更新日時

            // レコード追加
            $individual_score->save();


            // ログイン済みなら個別得点テーブル 登録
            if ( $user_id != 0 ){
              //KokushiQuestionController::storeScore($user_id, $subject_id, $title_id, $question_number, $flag_correct);
            }

            return view('kokushi.practice_by_question')
            ->with([
                    'subject_id'            =>      $subject_id,                // 科目ID
                    'question_sentence'     =>      $question_sentence,         // 問題文
                    'choice_sentences'      =>      $choice_sentences,          // 選択肢文
                    'subject_short_name'    =>      $subject_short_name,        // 科目略称
                    'question_last_number'  =>      $question_last_number,      // 最終問題番号
                    'choice_characters'     =>      $choice_characters,         // 選択肢文字配列
                    'number_of_need_select' =>      $numOfNeedSelect,           // 必須回答数
                    'number_of_answers'     =>      $number_of_answers,         // 正答数
                    'selected_answer'	      =>	    $selected_answer,           // 選択された回答
                    'array_sa'              =>      $array_selected_answers,    // 選択された回答配列
                    'array_ca'              =>      $answers,                   // 正答配列
                    'flag_correct'          =>      $flag_correct,              // 
                    'user_name'             =>      $user_name,                 // ユーザ名
                    'judges'                =>      $judges,                    // 正誤配列
                    'soundType'             =>      $soundType,                 // 正解時音声
            ]);
          }
        } else {
          
          /**
           * 必須回答数が複数
          **/

          // 選択された選択肢の数 初期化
          $numOfSelectedChoices = 0;

          // 選択肢の数 取得
          if ($request->selected_answer_0){
            //
            $numOfSelectedChoices++;
            $array_selected_answers[] = 0;
          }

          if ($request->selected_answer_1){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 1;
          }

          if ($request->selected_answer_2){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 2;
          }

          if ($request->selected_answer_3){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 3;
          }

          if ($request->selected_answer_4){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 4;
          }

          if ($request->selected_answer_5){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 5;
          }

          if ($request->selected_answer_6){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 6;
          }

          if ($request->selected_answer_7){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 7;
          }

          if ($request->selected_answer_8){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 8;
          }

          if ($request->selected_answer_9){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 9;
          }

          if ($request->selected_answer_10){
            $numOfSelectedChoices++;
            $array_selected_answers[] = 10;
          }

          /**
          *  選ばれた選択肢が、正答配列の中に存在するかを判定
          **/

          // 正答配列 取得
          $answers	=	Answer_sentences::where('subject_name_id', '=', $subject_id)
                              ->where('question_title_id', '=', $title_id)
                              ->where('question_number', '=', $question_number)
                              ->pluck('answer_sentence')
                              ->toArray();
                              //dd($answers);

          $count_correct = 0;         // 部分正解の数

          // 選ばれた選択肢の数
          for($i = 0; $i < $numOfSelectedChoices; $i++){
            $selected_answer_val  = (int)$array_selected_answers[$i] + 1;
            $selected_answer_val  = (string)$selected_answer_val;

            //dd($selected_answer_val, $answers);

            if(in_array($selected_answer_val, $answers, true)){
              // 部分正解

              $count_correct++;
            }
          }

          //dd($selected_answer_val, $numOfSelectedChoices);

          if ($count_correct == $numOfSelectedChoices){
            // 正解判定
            $flag_correct = 1;
          } else {
            // 不正解判定
            $flag_correct = 2;
          }

          // ログイン済みなら個別得点テーブル 登録
          if ( $user_id != 0){
            //KokushiController::storeScore($user_id, $subject_id, $title_id, $question_number, $flag_correct);

            //$user_id, $subject_id, $title_id, $question_number, $is_correct
          }

          return view('kokushi.practice_by_question')
          ->with([
                  'subject_id'            =>      $subject_id,                // 科目ID
                  'question_sentence'     =>      $question_sentence,         // 問題文
                  'choice_sentences'      =>      $choice_sentences,          // 選択肢文
                  'subject_short_name'    =>      $subject_short_name,        // 科目名略称
                  'question_last_number'  =>      $question_last_number,      // 最終問題番号
                  'choice_characters'     =>      $choice_characters,         // 選択肢 文字列
                  'number_of_need_select' =>      $numOfNeedSelect,           // 必須回答数
                  'number_of_answers'     =>      $number_of_answers,         // 正答の数
                  'selected_answer'	      =>	    $selected_answer,           // 選択済み選択肢
                  'array_sa'              =>      $array_selected_answers,    // 選択済み選択肢配列
                  'array_ca'              =>      $answers,                   // 正答配列
                  'flag_correct'          =>      $flag_correct,              // 正解フラグ
                  'user_name'             =>      $user_name,                 // ユーザ名
                  'judges'                =>      $judges,                    // 正誤配列
                  'soundType'             =>      $soundType,                 // 正解時音声
          ]);

        }
      }

      /*
      * 以降、判定ではない場合の処理
      */

        return view('kokushi.practice_by_question')
                  ->with([
                          'subject_id'            =>      $subject_id,                // 科目ID
                          'question_sentence'     =>      $question_sentence,         // 問題文
                          'choice_sentences'      =>      $choice_sentences,          // 選択肢文
                          'subject_short_name'    =>      $subject_short_name,        // 科目名略称
                          'question_last_number'  =>      $question_last_number,      // 最終問題番号
                          'choice_characters'     =>      $choice_characters,         // 選択肢文字列配列
                          'selected_answer'    	  =>    	$selected_answer,           // 
                          'array_sa'              =>      $array_selected_answers,    // 選択された正答配列
                          'number_of_need_select'	=>	    $numOfNeedSelect,           // 必須回答数
                          'number_of_answers'     =>      $number_of_answers,         // 正答数
                          'flag_correct'          =>      $flag_correct,              // 正答フラグ
                          'user_name'             =>      $user_name,                 // ユーザ名
                          'judges'                =>      $judges,                    // 正誤配列
                          'soundType'             =>      $soundType,                 // 正解時音声
                  ]);

/*
               )->withHeaders([
                          'Cache-Control'         =>      'no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0',
                          'Pragma'                =>      'no-cache',
               ]);
*/
    }


    /**
     * 科目IDを科目名英字略称へ変換
     */
    public function getShortName($subject_id){
      // 科目名略称（ディレクトリ名） 編集
      if($subject_id == 1){
        return 'nurse';
      } else if ($subject_id == 2){
        return 'phn';
      } else if ($subject_id == 3){
        return 'midwife';
      } else if ($subject_id == 4){
        return 'clt';
      } else if ($subject_id == 5){
        return 'rt';
      } else if ($subject_id == 6){
        return 'ort';
      } else if ($subject_id == 7){
        return 'ot';
      } else if ($subject_id == 8){
        return 'pt';
      } else if ($subject_id == 9){
        return 'jrt';
      } else if ($subject_id == 10){
        return '';
      } else if ($subject_id == 11){
        return 'fe';
      } else if ($subject_id == 12){
        return 'ap';
      } else if ($subject_id == 13){
        return 'nw';
      } else if ($subject_id == 14){
        return 'st';
      } else if ($subject_id == 15){
        return 'sa';
      } else if ($subject_id == 16){
        return 'sm';
      } else if ($subject_id == 17){
        return 'sc';
      } else if ($subject_id == 18){
        return 'pm';
      } else if ($subject_id == 19){
        return 'db';
      } else if ($subject_id == 20){
        return 'es';
      } else if ($subject_id == 21){
        return 'au';
      } else if ($subject_id == 22){
        return 'sg';
      } else if ($subject_id == 23){
        return 'up';
      }
    }

    /**
     * 科目IDを科目名漢字表記へ変換
     */
    public function getKanjiName($subject_id){
      // 科目名略称（ディレクトリ名） 編集
      if($subject_id == 1){
        return '看護師';
      } else if ($subject_id == 2){
        return '保険師';
      } else if ($subject_id == 3){
        return '助産師';
      } else if ($subject_id == 4){
        return '臨床検査技師';
      } else if ($subject_id == 5){
        return '診療放射線技師';
      } else if ($subject_id == 6){
        return '視能訓練士';
      } else if ($subject_id == 7){
        return '理学療法士';
      } else if ($subject_id == 8){
        return '作業療法士';
      } else if ($subject_id == 9){
        return '柔道整復師';
      } else if ($subject_id == 10){
        return '';
      } else if ($subject_id == 11){
        return '基本情報技術者';
      } else if ($subject_id == 12){
        return '応用情報技術者';
      } else if ($subject_id == 13){
        return 'ネットワークスペシャリスト';
      } else if ($subject_id == 14){
        return 'ITストラテジスト';
      } else if ($subject_id == 15){
        return 'システムアーキテクト';
      } else if ($subject_id == 16){
        return 'ITサービスマネージャ';
      } else if ($subject_id == 17){
        return '情報処理安全確保支援士';
      } else if ($subject_id == 18){
        return 'プロジェクトマネージャ';
      } else if ($subject_id == 19){
        return 'データベーススペシャリスト';
      } else if ($subject_id == 20){
        return 'エンベデッドシステムスペシャリスト';
      } else if ($subject_id == 21){
        return 'システム監査技術者';
      } else if ($subject_id == 22){
        return '情報セキュリティマネジメント';
      } else if ($subject_id == 23){
        return '高度区分共通';
      }
    }

    /**
     * 得点 登録処理
     */
    public function storeScore($user_id, $subject_id, $title_id, $question_number, $is_correct) {
      $times  = Individual_scorings::select('how_many_time')
                                  ->where('user_id', '=', $user_id)
                                  ->where('subject_name_id', '=', $subject_id)
                                  ->where('question_title_id', '=', $title_id)
                                  ->where('question_number', '=', $question_number)
                                  ->orderby('how_many_time', 'desc')
                                  ->value('how_many_time');

      // 既存データ 存在判定
      if(null === $times){
        $times  = 1;
      } else {
        $times++;
      }

      // 個別得点テーブル 登録
      $individula_scoring = new Individual_scorings();
      $individula_scoring->user_id            = $user_id;
      $individula_scoring->subject_name_id    = $subject_id;
      $individula_scoring->question_title_id = $title_id;
      $individula_scoring->question_number    = $question_number;
      $individula_scoring->how_many_time      = $times;
      $individula_scoring->is_correct         = $is_correct;
      $individula_scoring->created_at         = new Carbon('now');
      $individula_scoring->save();

    }


    /**
     * 履歴閲覧
     */
    public function history(Request $request){

        //      dd($subject_Kanji_name, $request->subject_id);

      $titles = Question_titles::where('subject_name_id', '=', $request->subject_id)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
        $user_id  = Auth::user()->id;
      } else {
        $logind = 0;
        $user_id  = 0;

      }

      // 累積挑戦数   キーバリューで取得・配列へ保存する必要がある。個別に取得しても意味ない
        //      $numOfTotalTry  = Individual_scorings::where('user_id', '=', $user_id)

      $subject_kanji_name   =   KokushiManagementController::getKanjiName($request->subject_id);


      return view('kokushi.history')
                ->with([
                    'subject_kanji_name'  =>  $subject_kanji_name,
                    'titles'              =>  $titles,
                    'logind'              =>  $logind,
                ]);
    }

}
