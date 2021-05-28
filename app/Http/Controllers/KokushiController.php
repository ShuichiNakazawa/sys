<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject_names;
use App\Fields;
use App\Questions_titles;
use App\Question_sentences;
use App\Question_sentence;
use App\Choice_sentences;
use App\Answer_sentences;
use App\Individual_scorings;
use App\T_choices;
use App\T_answers;

use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class KokushiController extends Controller
{

    // インデックス画面表示前処理
    public function before_kokushi() {

      // 分野マスタ 取得
      $fields = Fields::get();

      $fields_pluck = Fields::pluck('id', 'field_name');
      $All_subjects = array();

      $count = 0;

      foreach ($fields_pluck as $id => $field_name){

        // 科目リスト 取得
        $subjects = Subject_names::pluck('id', 'subject_name')
                                ->where('field_id', '=', $id);

        $All_subjects[$count] = $subjects;
        $count++;
      }

      dd($fields, $All_subjects, $fields_pluck);

      return view('kokushi.index')
              ->with([
                  'fields'    =>  $fields,
                  'subjects'  =>  $All_subjects,
              ]);
    }

    // 看護師 TOP
    public function nurseIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 1)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.nurse')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    // 保険師 TOP
    public function phnIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 2)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.phn')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }
    
    // 助産師 TOP
    public function midwifeIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 3)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.midwife')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }


    // 臨床検査技師 TOP
    public function cltIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 4)
                        ->where('sight_key', '=', 'origin')
                        ->orderby('title_id', 'desc')
                        ->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.clt')
                ->with([
                  'titles' => $titles,
                  'logind' => $logind,
                ]);
    }

/**
 * 科目メニュー
 */
    // 科目 登録処理
    public function storeSubject(Request $request){

      // 
      $subject   =  new Subject_names();
      $subject->subject_name  = $request->subject_name;
      $subject->sight_key     = 'origin';
      $subject->created_at    = new Carbon('now');
      $subject->updated_at    = new Carbon('now');
      $subject->save();

      //
      return redirect('/management/store_subject')
                ->with('message', '正常に登録できました。');
    }

    // 科目リスト 表示
    public function showSubjects() {

      // 科目リスト 取得
      $subject_lists =	Subject_names::get();

      //
      return view('kokushi.subject_list')
		->with(['subjects' => $subject_lists]);

    }

    // 科目 編集画面
    public function editSubject($subject_id) {

      // 科目リスト 取得
      $subject_list =	Subject_names::where('id', '=', $subject_id)
                                          ->orderby('title_id', 'desc')
                                          ->first();

      return view('kokushi.editSubject')
		              ->with([
			                    'subject' => $subject_list,
      ]);
    }

    // 科目 更新処理
    public function updateSubject(Request $request) {
      // バリデーション

      $update_column = [
                        'id'            =>  $request->subject_id,
                        'subject_name'  =>  $request->subject_name,
      ];

      // 科目テーブル 更新
      Subject_names::where('id', '=', $request->old_subject_id)
                        ->update($update_column);

      // 科目リスト 取得
      $subject_lists =  Subject_names::get();
      $subject_id       =       $request->subject_id;

      return redirect('/management/subject_list/' . $subject_id)
                ->with([
                        'subjects'      =>      $subject_lists,
                ]);
    }

    // 科目 削除
    public function destroySubject($id) {
      $subject  = Subject_names::where('id', '=', $id)
                                  ->first();

      // データ存在判定
      if(!$subject) {
        return redirect('/management/subject_list/')
                        ->withInput()
                        ->withErrors('データが存在しません。');
      }

      // 科目 削除
      $subject->delete();

      // リダイレクト
      return redirect('/management/subject_list/')
                        ->with('message', '削除しました。');
    }

/**
 * タイトルメニュー
 */
    public function getSubjects(){
      //科目一覧 取得
      $subjects = Subject_names::get();

      return view('kokushi.store_title')
                  ->with([
                    'subjects' => $subjects,
                  ]);
    }

    // タイトル 登録
    public function storeTitle(Request $request){

      // 問題タイトル インスタンス化
      $title  = new Questions_titles();

      $title->subject_name_id = $request->subject_id;     // 科目ID
      $title->title_id        = $request->title_id;       // タイトルID
      $title->questions_title = $request->title_name;     // 問題タイトル名
      $title->sight_key       = 'origin';                 // サイトキー
      $title->created_at      = new Carbon('now');        // 作成日時
      $title->updated_at      = new Carbon('now');        // 最終更新日時

      // 問題タイトル 登録
      $title->save();

      // 
      return redirect('/management/store_title')
                  ->with('message', '登録できました。');
    }

    // タイトルリスト 表示
    public function showTitles($subject_id) {
      // 科目リスト 取得
      $subject_lists =  Subject_names::get();

      // タイトルリスト 取得
      $title_lists	=	Questions_titles::where('subject_name_id', '=', $subject_id)
                                          ->where('sight_key', '=', 'origin')
                                          ->orderby('title_id', 'desc')
                                          ->get();

      //
      return view('kokushi.question_title')
                ->with([
                      'subjects'	  =>	$subject_lists,
                      'titles'	    =>	$title_lists,
                      'subject_id'	=>	$subject_id
                ]);
    }

    public function editTitle($subject_name_id, $id) {
      //タイトル情報 取得
      $questions_title	=	Questions_titles::where('id', '=', $id)
                                ->first();

      $title_id         = Questions_titles::select('title_id')
                                ->where('subject_name_id', '=', $subject_name_id)
                                ->orderby('title_id', 'desc')
                                ->limit(1)
                                ->value('title_id');

      if(!$title_id){
        $title_id = 1;
      } else {
        $title_id++;
      }

      $subject          = Subject_names::where('id', '=', $subject_name_id)
                                ->first();

      return view('kokushi.editTitle')
                  ->with([
                      'subject'       =>    $subject,
                      'title'         =>    $questions_title,
                      'title_id'      =>    $title_id,
      ]);
    }

    public function updateTitle(Request $request) {
      // バリデーション

      $update_column = [
                'title_id'        =>  $request->title_id,
                'questions_title'	=>  $request->questions_title,
                'updated_at'      =>  new Carbon('now'),
      ];

      // 問題タイトルテーブル 更新
      Questions_titles::where('id', '=', $request->id)
				->update($update_column);

      // 科目リスト 取得
      $subject_lists =  Subject_names::get();

      $subject_id       =       $request->subject_id;

      // タイトルリスト 取得
      $title_lists      =       Questions_titles::where('subject_name_id', '=', $subject_id)
                                        ->where('sight_key', '=', 'origin')
                                        ->get();

      return redirect('/management/title_list/' . $subject_id)
                ->with([
                        'subjects'      =>      $subject_lists,
                        'titles'        =>      $title_lists,
                        'subject_id'    =>      $subject_id
                ]);

    }

    public function destroyQuestionsTitle($id) {
      $title  = Questions_titles::where('id', '=', $id)
                                  ->first();
      if(!$title) {
        return redirect('/management/title_list/');
      }

      $subject_id = Questions_titles::select('subject_name_id')
                                        ->where('id', '=', $id)
                                        ->value('subject_name_id');
      $title->delete();
      return redirect('/management/title_list/'. $subject_id);
    }


/**
 * 問題文メニュー
 */
    public function getQInfos(Request $request) {

      // 科目リスト 取得
      $subject_lists =  Subject_names::get();

      // 科目名
      $subject_name     =       $request->subject_name;

      // タイトル名
      $questions_title  =       $request->questions_title;

      // 科目ID 取得
      $subject_id       =       Subject_names::select('id')
                                          ->where('subject_name', '=', $subject_name)
                                          ->limit(1)
                                          ->value('id');

      // タイトルリスト 取得
      $title_lists	=	Questions_titles::where('subject_name_id', '=', $subject_id)
                                          ->where('sight_key', '=', 'origin')
                                          ->orderby('title_id', 'desc')
                                          ->get();

      //
      return view('kokushi.store_q_sentence')
                ->with([
                      'subjects'	        =>	$subject_lists,
                      'titles'	          =>	$title_lists,
                      'subject_id'	      =>	$subject_id,
                      'subject_name'      =>  $subject_name,
                      'questions_title'   =>  $questions_title,
                      'question_number'   =>  '',
                ]);
    }

    public function showQuestionSentences(Request $request) {

      // 科目リスト 取得
      $subject_lists =  Subject_names::get();

      $subject_id       =       Subject_names::select('id')
                                        ->where('subject_name', '=', $request->subject_name)
                                        ->where('sight_key', '=', 'origin')
                                        ->value("id");

      // タイトルリスト 取得
      $title_lists      =       Questions_titles::where('subject_name_id', '=', $subject_id)
                                        ->where('sight_key', '=', 'origin')
                                        ->get();

      $qsentences	=	Question_sentences::where('subject_name', '=', $request->subject_name)
                        ->where('questions_title', '=', $request->questions_title)
                        ->where('sight_key', '=', 'origin')
                        ->orderby('question_number', 'asc')
                        ->get();

      return view('kokushi.qsentence_list')
                ->with([
                        'subjects'        =>  $subject_lists,
                        'titles'          =>  $title_lists,
                        'subject_id'      =>  $subject_id,
                        'subject_name'    =>  $request->subject_name,
                        'questions_title'	=>  $request->questions_title,
                        'qsentences'      =>  $qsentences,
                ]);
    }


    // 問題文 登録
    public function storeQSentence(Request $request){

      //dd($request);

      // 科目略称 取得
      $subject_short_name = KokushiController::getShortName($request->subject_name_id);

      // ファイル取得
      $file = $request->file('image');  //file取得
      if( !empty($file) ){                                             // ファイル存在チェック
        $filename = $file->getClientOriginalName();                    // ファイル名を取得
        $move     = $file->move('../image/' . '/'
                                  . $subject_short_name , $filename);  // ファイルを移動

      } else {
        $filename = "";

      }

      // タイトルID

      // 正答の数 算出
      $numOfAnswers = 0;
      $array_correct_answers = array();

      // 押下されているチェックボックスの数を取得
      if($request->answer1 == 'on'){
        $numOfAnswers++;
        $array_correct_answers[] = 1;
      }

      if($request->answer2 == 'on'){
        $numOfAnswers++;
        $array_correct_answers[] = 2;
      }

      if($request->answer3 == 'on'){
        $numOfAnswers++;
        $array_correct_answers[] = 3;
      }

      if($request->answer4 == 'on'){
        $numOfAnswers++;
        $array_correct_answers[] = 4;
      }

      if($request->answer5 == 'on'){
        $numOfAnswers++;
        $array_correct_answers[] = 5;
      }

      if($request->answer6 == 'on'){
        $numOfAnswers++;
        $array_correct_answers[] = 6;
      }

      if($request->answer7 == 'on'){
        $numOfAnswers++;
        $array_correct_answers[] = 7;
      }

      if($request->answer8 == 'on'){
        $numOfAnswers++;
        $array_correct_answers[] = 8;
      }

      if($request->answer9 == 'on'){
        $numOfAnswers++;
        $array_correct_answers[] = 9;
      }

      //dd($required_numOfAnswers, $array_correct_answers);
      // 押下されているチェックボックスを元に、正答テーブルを更新

      // 問題文モデル インスタンス化
      $question_sentence  = new Question_sentences();

      $question_sentence->subject_id            = $request->subject_name_id;        // 科目ID
      $question_sentence->subject_name          = '';                               // 科目名

      $question_sentence->questions_title_id    = $request->questions_title_id;     // タイトルID
      $question_sentence->questions_title       = '';                               // 問題タイトル名
      $question_sentence->question_number       = $request->question_number;        // 問題番号

      $question_sentence->division1             = '';                               // 分野名１
      $question_sentence->division2             = '';                               // 分野名２
      $question_sentence->division3             = '';                               // 分野名３

      $question_sentence->question_sentence     = $request->question_sentence;      // 問題文
      $question_sentence->flag_graph_exists     = $request->flag_graph_exists;      // 図表存在フラグ
      $question_sentence->image_filename        = $filename;                        // 図表ファイル名
      $question_sentence->required_numOfAnswers = $request->required_numOfAnswers;  // 必須回答数

      $question_sentence->number_of_choices     = $request->number_of_choices;      // 選択肢数
      $question_sentence->number_of_answers     = $numOfAnswers;                    // 正答の数

      $question_sentence->sight_key             = 'origin';                         // サイトキー
      $question_sentence->created_at            = new Carbon('now');                // 作成日時
      $question_sentence->updated_at            = new Carbon('now');                // 最終更新日時

      //dd($question_sentence);

      // 問題文 登録
      $question_sentence->save();

      /**
       * 選択肢文 登録処理
       **/
      // 登録用配列 宣言
      $array_insert_choice_sentences = array();

      // 選択肢文 登録
      for($index = 0; $index < $request->number_of_choices; $index++){

        // 選択肢 取得
        if($index == 0){
          $c_sentence = $request->choice1;
        } else if($index == 1){
          $c_sentence = $request->choice2;
        } else if($index == 2){
          $c_sentence = $request->choice3;
        } else if($index == 3){
          $c_sentence = $request->choice4;
        } else if($index == 4){
          $c_sentence = $request->choice5;
        } else if($index == 5){
          $c_sentence = $request->choice6;
        } else if($index == 6){
          $c_sentence = $request->choice7;
        } else if($index == 7){
          $c_sentence = $request->choice8;
        } else if($index == 8){
          $c_sentence = $request->choice9;
        }

        $array_choice_sentence = 
              [
                'subject_name_id'     =>  $request->subject_name_id,        // 科目ID
                'subject_name'        =>  '',                               // 科目名
                'questions_title_id'  =>  $request->questions_title_id,     // タイトルID
                'questions_title'     =>  '',                               // タイトル名
                'question_number'     =>  $request->question_number,        // 問題番号
                'choice_id'           =>  $index,                           // 選択肢ID
                'choice_sentence'     =>  $c_sentence,                      // 選択肢文
                'sight_key'           =>  'origin',                         // サイトキー
                'created_at'          =>  new Carbon('now'),                // 登録日時
                'updated_at'          =>  new Carbon('now'),                // 更新日時
              ];
        
        // 更新用配列へ追加
        $array_insert_choice_sentences[] = $array_choice_sentence;
      }

      //dd($array_insert_choice_sentences);

      // 選択肢テーブルへ登録
      DB::table('choice_sentences')->insert($array_insert_choice_sentences);

      // 登録用配列 宣言
      $array_insert_answer_sentences = array();

      // 選択肢文 登録
      for($index_answer = 0; $index_answer < $numOfAnswers; $index_answer++){

        // 正答番号 取得
        $answer_number  =  $array_correct_answers[$index_answer];

        $a_sentence = $answer_number;

        /*
        if($answer_number == 0){
          $a_sentence = $request->answer1;
        } else if($answer_number == 1){
          $a_sentence = $request->answer2;
        } else if($answer_number == 2){
          $a_sentence = $request->answer3;
        } else if($answer_number == 3){
          $a_sentence = $request->answer4;
        } else if($answer_number == 4){
          $a_sentence = $request->answer5;
        } else if($answer_number == 5){
          $a_sentence = $request->answer6;
        } else if($answer_number == 6){
          $a_sentence = $request->answer7;
        } else if($answer_number == 7){
          $a_sentence = $request->answer8;
        } else if($answer_number == 8){
          $a_sentence = $request->answer9;
        }
        */

        $array_answer_sentence = 
              [
                'subject_name_id'     =>  $request->subject_name_id,        // 科目ID
                'subject_name'        =>  '',                               // 科目名
                'questions_title_id'  =>  $request->questions_title_id,     // タイトルID
                'questions_title'     =>  '',                               // タイトル名
                'question_number'     =>  $request->question_number,        // 問題番号
                'answer_id'           =>  $index_answer,                    // 正答ID
                'answer_sentence'     =>  $a_sentence,                      // 正答文
                'sight_key'           =>  'origin',                         // サイトキー
                'created_at'          =>  new Carbon('now'),                // 登録日時
                'updated_at'          =>  new Carbon('now'),                // 更新日時
              ];
        
        // 更新用配列へ追加
        $array_insert_answer_sentences[] = $array_answer_sentence;
      }

      //dd($array_insert_answer_sentences);

      // 正答テーブルへ登録
      DB::table('answer_sentences')->insert($array_insert_answer_sentences);

      // 科目リスト 取得
      $subject_lists =  Subject_names::get();

      // 科目ID $request->subject_name_id

      // 科目名
      $subject_name     =       Subject_names::select('subject_name')
                                                ->where('id', '=', $request->subject_name_id)
                                                ->value('subject_name');

      // タイトル名
      $questions_title  =       Questions_titles::select('questions_title')
                                                  ->where('title_id', '=', $request->questions_title_id)
                                                  ->value('questions_title');

      // 科目ID 取得
      $subject_id       =       $request->subject_name_id;
      /*
      $subject_id       =       Subject_names::select('id')
                                          ->where('subject_name', '=', $request->subject_name)
                                          ->limit(1)
                                          ->value('id');
*/

      // タイトルリスト 取得
      $title_lists	=	Questions_titles::where('subject_name_id', '=', $subject_id)
                                          ->where('sight_key', '=', 'origin')
                                          ->orderby('title_id', 'desc')
                                          ->get();

      // 
      $question_number  = $request->question_number + 1;

      \Session::flash('message', '登録できました。');

      // 
      return view('kokushi.store_q_sentence')
                      ->with([
                                'subjects'	        =>  $subject_lists,
                                'titles'	          =>  $title_lists,
                                'subject_id'	      =>  $subject_id,
                                'subject_name'      =>  $subject_name,
                                'questions_title'   =>  $questions_title,
                                'question_number'   =>  $question_number,
                      ]);
    }

    public function audio($subject_id){
      //参照するフォルダを指定
      $folder_name	=	'subject_id' . $subject_id;

      return view('kokushi.audio')
		->with([
			'folder_name'	=>	$folder_name,
		]);

    }

    public function startPractice(Request $request){
      $subject_id		      =	$request->subject_id;               // 科目ID
      $questions_title    = $request->questions_title;          // タイトル名
      $questions_title_id	= Questions_titles::select('title_id')
                                      ->where('subject_name_id', '=', $subject_id)
                                      ->where('questions_title', '=', $questions_title)
                                      ->where('sight_key', '=', 'origin')
                                      ->value('title_id');

      //dd($subject_id, $questions_title);

      // 問題文 取得
      $question_sentence        =       Question_sentences::where('subject_id', '=', $subject_id)
                                                ->where('questions_title_id', '=', $questions_title_id)
                                                ->where('question_number', '=', 1)
                                                ->first();

      //dd($question_sentence);

      // 最終問題番号 取得 （下のコメントを流用）
      $question_last_number     =       Question_sentences::select('question_number')
                                                        ->where('subject_id', '=', $subject_id)
                                                        ->where('questions_title_id', '=', $questions_title_id)
                                                        ->orderby('question_number', 'desc')
                                                        ->limit(1)
                                                        ->value('question_number');

      // 選択肢ボタンの文字配列 設定
      $choice_characters        =       [
                                                'ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ',
                                        ];

      // 選択肢 取得
      $choice_sentences         =       Choice_sentences::where('subject_name_id', '=', $subject_id)
                                                ->where('questions_title_id', '=', $questions_title_id)
                                                ->where('question_number', '=', 1)
                                                ->get();

      // 科目略称 設定
      $subject_short_name   = KokushiController::getShortName($subject_id);

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
        return redirect($subject_short_name . '/practice_by_question/' . $subject_id . '/' . $questions_title_id . '/1')
                  ->with([
                        'question_sentence'     =>      $question_sentence,
                        'choice_sentences'      =>      $choice_sentences,
                        'subject_short_name'    =>      $subject_short_name,
                        'question_last_number'  =>      $question_last_number,
                        'selected_answer'    	  =>    	'99',
                        'choice_characters'     =>      $choice_characters,
                 ]);


      } else if ($request->testType == 2){
        return redirect($subject_short_name . '/practice/' . $subject_id . '/' . $questions_title_id . '/1')
                  ->with([
                        'question_sentence'     =>      $question_sentence,
                        'choice_sentences'      =>      $choice_sentences,
                        'subject_short_name'    =>      $subject_short_name,
                        'question_last_number'  =>      $question_last_number,
                        'choice_characters'     =>      $choice_characters,
                        'selected_answer'    	  =>    	'99',
                 ]);
      }

    }

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
      $question_title	=	Questions_titles::select('questions_title')
					->where('subject_name_id', '=', $subject_id)
					->where('title_id', '=', $title_id)
					->value('questions_title');

      // 問題文 取得
      $question_sentence	=	Question_sentences::where('subject_id', '=', $subject_id)
						->where('questions_title', '=', $question_title)
						->where('question_number', '=', $question_number)
						->first();

      // 選択肢 取得
      $choice_sentences		=	Choice_sentences::where('subject_name_id', '=', $subject_id)
                                                ->where('questions_title', '=', $question_title)
                                                ->where('question_number', '=', $question_number)
                                                ->get();

      // 正答数 取得
      $number_of_answers	=	Answer_sentences::where('subject_name_id', '=', $subject_id)
						->where('questions_title', '=', $question_title)
						->where('question_number', '=', $question_number)
						->count();

      // 科目略称 設定
      $subject_short_name   = KokushiController::getShortName($subject_id);

      // 選択肢ボタンの文字配列 設定
      $choice_characters	=	[
						'ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ',
					];

      // 最終問題番号 取得 （下のコメントを流用）
      $question_last_number	=	Question_sentences::select('question_number')
							->where('subject_id', '=', $subject_id)
                                                	->where('questions_title', '=', $question_title)
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


/*
*  一問一答
*/

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
      $subject_short_name   = KokushiController::getShortName($subject_id);

      //dd($subject_short_name);

      // 必須回答数 取得
      $numOfNeedSelect	=	Question_sentences::select('required_numOfAnswers')
                ->where('subject_id', '=', $subject_id)
                ->where('questions_title_id', '=', $title_id)
                ->where('question_number', '=', $question_number)
                ->limit(1)
                ->value('required_numOfAnswers');

      // 問題文 取得
      $question_sentence        =       Question_sentences::where('subject_id', '=', $subject_id)
                                                ->where('questions_title_id', '=', $title_id)
                                                ->where('question_number', '=', $question_number)
                                                ->first();

      // 選択肢 取得
      $choice_sentences         =       Choice_sentences::where('subject_name_id', '=', $subject_id)
                                                ->where('questions_title_id', '=', $title_id)
                                                ->where('question_number', '=', $question_number)
                                                ->get();

      // 最終問題番号 取得 （下のコメントを流用）
      $question_last_number     =       Question_sentences::select('question_number')
                                                          ->where('subject_id', '=', $subject_id)
                                                          ->where('questions_title_id', $title_id)
                                                          ->orderby('question_number', 'desc')
                                                          ->limit(1)
                                                          ->value('question_number');

      // 選択肢ボタンの文字配列 設定
      $choice_characters        =       [
                                                  'ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ',
                                          ];


      // 正答数 取得
      $number_of_answers        =       Answer_sentences::where('subject_name_id', '=', $subject_id)
                                                ->where('questions_title_id', '=', $title_id)
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
                        ->where('questions_title_id', '=', $title_id)
                        ->where('question_number', '=', $question_number)
                        ->count();

        // 必須回答数 判定
        if ($numOfNeedSelect == 1){

          // 正答の数 判定
          if ($numOfAnswers == 1){
            $answer	=	Answer_sentences::select('answer_sentence')
                                                        ->where('subject_name_id', '=', $subject_id)
                                                        ->where('questions_title_id', '=', $title_id)
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
              KokushiController::storeScore($user_id, $subject_id, $title_id, $question_number, $flag_correct);
            }

            // 正解としてビューを返す
            return view('kokushi.practice_by_question')
                        ->with([
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
                                        ->where('questions_title_id', '=', $title_id)
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
              KokushiController::storeScore($user_id, $subject_id, $title_id, $question_number, $flag_correct);
            }

            return view('kokushi.practice_by_question')
            ->with([
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
                              ->where('questions_title_id', '=', $title_id)
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
            KokushiController::storeScore($user_id, $subject_id, $title_id, $question_number, $flag_correct);

            //$user_id, $subject_id, $title_id, $question_number, $is_correct
          }

          return view('kokushi.practice_by_question')
          ->with([
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
                                  ->where('questions_title_id', '=', $title_id)
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
      $individula_scoring->questions_title_id = $title_id;
      $individula_scoring->question_number    = $question_number;
      $individula_scoring->how_many_time      = $times;
      $individula_scoring->is_correct         = $is_correct;
      $individula_scoring->created_at         = new Carbon('now');
      $individula_scoring->save();

    }

    public function history(Request $request){

        //      dd($subject_Kanji_name, $request->subject_id);

      $titles = Questions_titles::where('subject_name_id', '=', $request->subject_id)
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

      $subject_kanji_name   =   KokushiController::getKanjiName($request->subject_id);


      return view('kokushi.history')
                ->with([
                    'subject_kanji_name'  =>  $subject_kanji_name,
                    'titles'              =>  $titles,
                    'logind'              =>  $logind,
                ]);
    }

    /**
     * 基本情報技術者
     */
    public function feIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 11)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.fe')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * 応用情報技術者
     */
    public function apIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 12)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.ap')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * ネットワークスペシャリスト
     */
    public function nwIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 13)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.nw')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * ITストラテジスト
     */
    public function stIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 14)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.st')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * システムアーキテクト
     */
    public function saIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 15)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.sa')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * ITサービスマネージャ
     */
    public function smIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 16)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.sm')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * 情報処理安全確保支援士
     */
    public function scIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 17)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.sc')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * プロジェクトマネージャ
     */
    public function pmIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 18)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.pm')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * データベーススペシャリスト
     */
    public function dbIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 19)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.db')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }
    /**
     * エンベデッドシステムスペシャリスト
     */
    public function esIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 20)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.es')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }


    /**
     * システム監査技術者
     */
    public function auIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 21)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.au')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * 情報セキュリティマネジメント
     */
    public function sgIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 22)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.sg')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);;
    }

    /**
     * 高度区分共通
     */
    public function upIndex() {

      $titles = Questions_titles::where('subject_name_id', '=', 23)
			->where('sight_key', '=', 'origin')
			->orderby('title_id', 'desc')
			->get();

      if (null !== Auth::user()){
        $logind = 1;
      } else {
        $logind = 0;
      }

      return view('kokushi.up')
            ->with([
              'titles'  => $titles,
              'logind' => $logind,
            ]);
    }

    public function merge(Request $request) {

      if ($request->migration_table == 't_choices データ移行'){
        // t_choice テーブル全件取得
        $t_choices  = T_choices::get();

        foreach ($t_choices as $t_choice){

          // 科目ID・科目名 設定
          if($t_choice->ExamType == 'fe'){
            $subject_id       = 11;
            $questions_title  = '基本情報技術者';

          } else if($t_choice->ExamType == 'ap'){
            $subject_id       = 12;
            $questions_title  = '応用情報技術者';

          } else if($t_choice->ExamType == 'nw'){
            $subject_id       = 13;
            $questions_title  = 'ネットワークスペシャリスト';

          } else if($t_choice->ExamType == 'st'){
            $subject_id       = 14;
            $questions_title  = 'ITストラテジスト';

          } else if($t_choice->ExamType == 'sa'){
            $subject_id       = 15;
            $questions_title  = 'システムアーキテクト';

          } else if($t_choice->ExamType == 'sm'){
            $subject_id       = 16;
            $questions_title  = 'ITサービスマネージャ';

          } else if($t_choice->ExamType == 'sc'){
            $subject_id       = 17;
            $questions_title  = '情報処理安全確保支援士';

          } else if($t_choice->ExamType == 'pm'){
            $subject_id       = 18;
            $questions_title  = 'プロジェクトマネージャ';

          } else if($t_choice->ExamType == 'db'){
            $subject_id       = 19;
            $questions_title  = 'データベーススペシャリスト';

          } else if($t_choice->ExamType == 'es'){
            $subject_id       = 20;
            $questions_title  = 'エンベデッドシステムスペシャリスト';

          } else if($t_choice->ExamType == 'au'){
            $subject_id       = 21;
            $questions_title  = 'システム監査技術者';

          } else if($t_choice->ExamType == 'sg'){
            $subject_id       = 22;
            $questions_title  = '情報セキュリティマネジメント';

          } else if($t_choice->ExamType == 'up'){
            $subject_id       = 23;
            $questions_title  = '高度区分共通';
          }

          $questions_title = '';

          // 開催年 判定
          if($t_choice->Year == 'r2'){
            $questions_title = '令和２年';

          } else if($t_choice->Year == 'r1'){
            $questions_title = '令和元年';

          } else if($t_choice->Year == 'h31'){
            $questions_title = '平成３１年';

          } else if($t_choice->Year == 'h30'){
            $questions_title = '平成３０年';

          } else if($t_choice->Year == 'h29'){
            $questions_title = '平成２９年';

          } else if($t_choice->Year == 'h28'){
            $questions_title = '平成２８年';

          } else if($t_choice->Year == 'h27'){
            $questions_title = '平成２７年';
          }

          // 季節判定
          if ($t_choice->Season == 1){
            $questions_title .= '春期 ';
          } else if ($t_choice->Season == 2){
            $questions_title .= '秋期 ';
          }

          // 時間帯設定
          if ($t_choice->TimeZone == 'am'){
            $questions_title .= '午前';
          } else if ($t_choice->TimeZone == 'am1'){
            $questions_title .= '午前１';
          } else if ($t_choice->TimeZone == 'am2'){
            $questions_title .= '午前２';
          }

          $questions_title_id   =   99;

          if ($questions_title == '令和２年秋期 午前'){
            $questions_title_id = 50;
          } else if ($questions_title == '令和２年春期 午前'){
            $questions_title_id = 48;
          } else if ($questions_title == '令和２年春期 午前１'){
            $questions_title_id = 481;
          } else if ($questions_title == '令和２年春期 午前２'){
            $questions_title_id = 482;
          } else if ($questions_title == '令和元年秋期 午前'){
            $questions_title_id = 46;
          } else if ($questions_title == '令和元年秋期 午前１'){
            $questions_title_id = 461;
          } else if ($questions_title == '令和元年秋期 午前２'){
            $questions_title_id = 462;
          } else if ($questions_title == '平成３１年春期 午前'){
            $questions_title_id = 44;
          } else if ($questions_title == '平成３１年春期 午前１'){
            $questions_title_id = 441;
          } else if ($questions_title == '平成３１年春期 午前２'){
            $questions_title_id = 442;
          } else if ($questions_title == '平成３０年秋期 午前'){
            $questions_title_id = 42;
          } else if ($questions_title == '平成３０年秋期 午前１'){
            $questions_title_id = 421;
          } else if ($questions_title == '平成３０年秋期 午前２'){
            $questions_title_id = 422;
          } else if ($questions_title == '平成３０年春期 午前'){
            $questions_title_id = 40;
          } else if ($questions_title == '平成３０年春期 午前１'){
            $questions_title_id = 401;
          } else if ($questions_title == '平成３０年春期 午前２'){
            $questions_title_id = 402;
          } else if ($questions_title == '平成２９年秋期 午前'){
            $questions_title_id = 38;
          } else if ($questions_title == '平成２９年秋期 午前１'){
            $questions_title_id = 381;
          } else if ($questions_title == '平成２９年秋期 午前２'){
            $questions_title_id = 382;
          } else if ($questions_title == '平成２９年春期 午前'){
            $questions_title_id = 36;
          } else if ($questions_title == '平成２９年春期 午前１'){
            $questions_title_id = 361;
          } else if ($questions_title == '平成２９年春期 午前２'){
            $questions_title_id = 362;
          } else if ($questions_title == '平成２８年秋期 午前'){
            $questions_title_id = 34;
          } else if ($questions_title == '平成２８年秋期 午前１'){
            $questions_title_id = 341;
          } else if ($questions_title == '平成２８年秋期 午前２'){
            $questions_title_id = 342;
          } else if ($questions_title == '平成２８年春期 午前'){
            $questions_title_id = 32;
          } else if ($questions_title == '平成２８年春期 午前１'){
            $questions_title_id = 321;
          } else if ($questions_title == '平成２８年春期 午前２'){
            $questions_title_id = 322;
          } else if ($questions_title == '平成２７年秋期 午前'){
            $questions_title_id = 30;
          } else if ($questions_title == '平成２７年秋期 午前１'){
            $questions_title_id = 301;
          } else if ($questions_title == '平成２７年秋期 午前２'){
            $questions_title_id = 302;
          } else if ($questions_title == '平成２７年春期 午前'){
            $questions_title_id = 28;
          } else if ($questions_title == '平成２７年春期 午前１'){
            $questions_title_id = 281;
          } else if ($questions_title == '平成２７年春期 午前１'){
            $questions_title_id = 282;
          }

          // 問題番号
          $question_number  = $t_choice->QuestionNumber;

          // 選択肢 1~4  取得
          $array_choice[0]                        = $t_choice->Choice1;
          $array_choice[1]                        = $t_choice->Choice2;
          $array_choice[2]                        = $t_choice->Choice3;
          $array_choice[3]                        = $t_choice->Choice4;

          // 選択肢文の設定、テーブルへ登録
          for($i = 0; $i < 4; $i++){
            
            // 選択肢テーブル 基本情報設定
            $choice_sentence = new Choice_sentences();
            $choice_sentence->subject_name_id          = $subject_id;                               // 科目ID
            $choice_sentence->subject_name        = KokushiController::getKanjiName($subject_id);   // 科目名
            $choice_sentence->questions_title_id  = $questions_title_id;                            // 問題タイトルID
            $choice_sentence->questions_title     = $questions_title;                               // 問題タイトル名
            $choice_sentence->question_number     = $question_number;                               // 問題番号
            $choice_sentence->sight_key           = 'origin';                                       // サイトキー
            $choice_sentence->created_at          = new Carbon('now');                              // 作成日時
            $choice_sentence->updated_at          = new Carbon('now');                              // 更新日時

            $choice_sentence->choice_id         = $i;
            $choice_sentence->choice_sentence   = $array_choice[$i];
            $choice_sentence->save();
          }
        }



      } else if($request->migration_table == 't_answers データ移行'){
        // t_answers テーブル全件取得
        $t_answers  = T_answers::get();

        foreach ($t_answers as $t_answer){

          // 科目ID・科目名 設定
          if($t_answer->ExamType == 'fe'){
            $subject_id       = 11;
            $questions_title  = '基本情報技術者';

          } else if($t_answer->ExamType == 'ap'){
            $subject_id       = 12;
            $questions_title  = '応用情報技術者';

          } else if($t_answer->ExamType == 'nw'){
            $subject_id       = 13;
            $questions_title  = 'ネットワークスペシャリスト';

          } else if($t_answer->ExamType == 'st'){
            $subject_id       = 14;
            $questions_title  = 'ITストラテジスト';

          } else if($t_answer->ExamType == 'sa'){
            $subject_id       = 15;
            $questions_title  = 'システムアーキテクト';

          } else if($t_answer->ExamType == 'sm'){
            $subject_id       = 16;
            $questions_title  = 'ITサービスマネージャ';

          } else if($t_answer->ExamType == 'sc'){
            $subject_id       = 17;
            $questions_title  = '情報処理安全確保支援士';

          } else if($t_answer->ExamType == 'pm'){
            $subject_id       = 18;
            $questions_title  = 'プロジェクトマネージャ';

          } else if($t_answer->ExamType == 'db'){
            $subject_id       = 19;
            $questions_title  = 'データベーススペシャリスト';

          } else if($t_answer->ExamType == 'es'){
            $subject_id       = 20;
            $questions_title  = 'エンベデッドシステムスペシャリスト';

          } else if($t_answer->ExamType == 'au'){
            $subject_id       = 21;
            $questions_title  = 'システム監査技術者';

          } else if($t_answer->ExamType == 'sg'){
            $subject_id       = 22;
            $questions_title  = '情報セキュリティマネジメント';

          } else if($t_answer->ExamType == 'up'){
            $subject_id       = 23;
            $questions_title  = '高度区分共通';
          }

          $questions_title = '';

          // 開催年 判定
          if($t_answer->Year == 'r2'){
            $questions_title = '令和２年';

          } else if($t_answer->Year == 'r1'){
            $questions_title = '令和元年';

          } else if($t_answer->Year == 'h31'){
            $questions_title = '平成３１年';

          } else if($t_answer->Year == 'h30'){
            $questions_title = '平成３０年';

          } else if($t_answer->Year == 'h29'){
            $questions_title = '平成２９年';

          } else if($t_answer->Year == 'h28'){
            $questions_title = '平成２８年';

          } else if($t_answer->Year == 'h27'){
            $questions_title = '平成２７年';
          }

          // 季節判定
          if ($t_answer->Season == 1){
            $questions_title .= '春期 ';
          } else if ($t_answer->Season == 2){
            $questions_title .= '秋期 ';
          }

          // 時間帯設定
          if ($t_answer->TimeZone == 'am'){
            $questions_title .= '午前';
          } else if ($t_answer->TimeZone == 'am1'){
            $questions_title .= '午前１';
          } else if ($t_answer->TimeZone == 'am2'){
            $questions_title .= '午前２';
          }

          $questions_title_id   =   99;

          if ($questions_title == '令和２年秋期 午前'){
            $questions_title_id = 50;
          } else if ($questions_title == '令和２年春期 午前'){
            $questions_title_id = 48;
          } else if ($questions_title == '令和２年春期 午前１'){
            $questions_title_id = 481;
          } else if ($questions_title == '令和２年春期 午前２'){
            $questions_title_id = 482;
          } else if ($questions_title == '令和元年秋期 午前'){
            $questions_title_id = 46;
          } else if ($questions_title == '令和元年秋期 午前１'){
            $questions_title_id = 461;
          } else if ($questions_title == '令和元年秋期 午前２'){
            $questions_title_id = 462;
          } else if ($questions_title == '平成３１年春期 午前'){
            $questions_title_id = 44;
          } else if ($questions_title == '平成３１年春期 午前１'){
            $questions_title_id = 441;
          } else if ($questions_title == '平成３１年春期 午前２'){
            $questions_title_id = 442;
          } else if ($questions_title == '平成３０年秋期 午前'){
            $questions_title_id = 42;
          } else if ($questions_title == '平成３０年秋期 午前１'){
            $questions_title_id = 421;
          } else if ($questions_title == '平成３０年秋期 午前２'){
            $questions_title_id = 422;
          } else if ($questions_title == '平成３０年春期 午前'){
            $questions_title_id = 40;
          } else if ($questions_title == '平成３０年春期 午前１'){
            $questions_title_id = 401;
          } else if ($questions_title == '平成３０年春期 午前２'){
            $questions_title_id = 402;
          } else if ($questions_title == '平成２９年秋期 午前'){
            $questions_title_id = 38;
          } else if ($questions_title == '平成２９年秋期 午前１'){
            $questions_title_id = 381;
          } else if ($questions_title == '平成２９年秋期 午前２'){
            $questions_title_id = 382;
          } else if ($questions_title == '平成２９年春期 午前'){
            $questions_title_id = 36;
          } else if ($questions_title == '平成２９年春期 午前１'){
            $questions_title_id = 361;
          } else if ($questions_title == '平成２９年春期 午前２'){
            $questions_title_id = 362;
          } else if ($questions_title == '平成２８年秋期 午前'){
            $questions_title_id = 34;
          } else if ($questions_title == '平成２８年秋期 午前１'){
            $questions_title_id = 341;
          } else if ($questions_title == '平成２８年秋期 午前２'){
            $questions_title_id = 342;
          } else if ($questions_title == '平成２８年春期 午前'){
            $questions_title_id = 32;
          } else if ($questions_title == '平成２８年春期 午前１'){
            $questions_title_id = 321;
          } else if ($questions_title == '平成２８年春期 午前２'){
            $questions_title_id = 322;
          } else if ($questions_title == '平成２７年秋期 午前'){
            $questions_title_id = 30;
          } else if ($questions_title == '平成２７年秋期 午前１'){
            $questions_title_id = 301;
          } else if ($questions_title == '平成２７年秋期 午前２'){
            $questions_title_id = 302;
          } else if ($questions_title == '平成２７年春期 午前'){
            $questions_title_id = 28;
          } else if ($questions_title == '平成２７年春期 午前１'){
            $questions_title_id = 281;
          } else if ($questions_title == '平成２７年春期 午前１'){
            $questions_title_id = 282;
          }

          // 問題番号
          $question_number  = $t_answer->QuestionNumber;

          // 正答1  取得
          $answer_sentence1                        = $t_answer->Answer1;

          // 選択肢テーブル 基本情報設定
          $answer_sentence = new Answer_sentences();
          $answer_sentence->subject_name_id     = $subject_id;                                    // 科目ID
          $answer_sentence->subject_name        = KokushiController::getKanjiName($subject_id);   // 科目名
          $answer_sentence->questions_title_id  = $questions_title_id;                            // 問題タイトルID
          $answer_sentence->questions_title     = $questions_title;                               // 問題タイトル名
          $answer_sentence->question_number     = $question_number;                               // 問題番号
          $answer_sentence->sight_key           = 'origin';                                       // サイトキー
          $answer_sentence->created_at          = new Carbon('now');                              // 作成日時
          $answer_sentence->updated_at          = new Carbon('now');                              // 更新日時

          $answer_sentence->answer_id           = 0;                                              // 正答ID
          $answer_sentence->answer_sentence     = $answer_sentence1;                               // 正答文

          // 正答テーブルへ登録
          $answer_sentence->save();

        }
      }
    }
}
