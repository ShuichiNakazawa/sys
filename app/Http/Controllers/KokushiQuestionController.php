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
use App\Individual_scorings;
use App\T_choices;
use App\T_answers;
use App\Subject_group;

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
        $subject_id		    =	$request->subject_id;               // 科目ID
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
        $subject_short_name   = subjectClass::getShortName($subject_id);
  
        //dd($question_sentence);

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

        //dd($request->testType);

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

      if(null !== Auth::user() ){
        $user_id  = Auth::user()->id;     // ユーザーID
      } else {
        $user_id  = 0;
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

            // ログイン済みなら個別得点テーブル 登録
            if ( $user_id != 0){
              //KokushiQuestionController::storeScore($user_id, $subject_id, $title_id, $question_number, $flag_correct);
            }

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

            // ログイン済みなら個別得点テーブル 登録
            if ( $user_id != 0 ){
              //KokushiQuestionController::storeScore($user_id, $subject_id, $title_id, $question_number, $flag_correct);
            }

            return view('kokushi.practice_by_question')
            ->with([
                    'subject_id'            =>      $subject_id,
                    'question_sentence'     =>      $question_sentence,
                    'choice_sentences'      =>      $choice_sentences,
                    'subject_short_name'    =>      $subject_short_name,
                    'question_last_number'  =>      $question_last_number,
                    'choice_characters'     =>      $choice_characters,
                    'number_of_need_select' =>      $numOfNeedSelect,
                    'number_of_answers'     =>      $number_of_answers,
                    'selected_answer'	      =>	    $selected_answer,
                    'array_sa'              =>      $array_selected_answers,
                    'array_ca'              =>      $answers,
                    'flag_correct'          =>      $flag_correct,
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
          ]);

        }
      }

      /*
      * 以降、判定ではない場合の処理
      */

        return view('kokushi.practice_by_question')
                  ->with([
                          'subject_id'            =>      $subject_id,                // 科目ID
                          'question_sentence'     =>      $question_sentence,
                          'choice_sentences'      =>      $choice_sentences,
                          'subject_short_name'    =>      $subject_short_name,
                          'question_last_number'  =>      $question_last_number,
                          'choice_characters'     =>      $choice_characters,
                          'selected_answer'    	  =>    	$selected_answer,
                          'array_sa'              =>      $array_selected_answers,
                          'number_of_need_select'	=>	    $numOfNeedSelect,
                          'number_of_answers'     =>      $number_of_answers,
                          'flag_correct'          =>      $flag_correct,
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