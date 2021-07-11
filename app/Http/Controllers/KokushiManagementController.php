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

class KokushiManagementController extends Controller
{
/**
 * 科目グループ
 */

    // 科目グループ　登録画面　表示処理
    public function pageStoreSubjectGroups(){


      return view('kokushi.store_subject_group')
              ->with([
                'subject_groups'  =>  $subject_groups,
              ]);
    }

    // 科目グループ 登録処理
    public function storeSubjectGroup(Request $request){

      // 
      $subject_group   =  new Subject_group();
      $subject_group->subject_group_name  = $request->subject_group_name;
      $subject_group->sight_key     = 'origin';
      $subject_group->created_at    = new Carbon('now');
      $subject_group->updated_at    = new Carbon('now');
      $subject_group->save();

      //
      return redirect('/kokushi/management/store_subject_group')
                ->with('message', '正常に登録できました。');
    }


    // 科目グループリスト 表示
    public function showSubjectGroups() {

      // 科目リスト 取得
      $subject_group_lists =	Subject_group::get();

      //
      return view('kokushi.subject_group_list')
		->with(['subject_groups' => $subject_group_lists]);

    }


    // 科目グループ 削除
    public function destroySubjectGroup($id) {
      $subject_group  = Subject_Group::where('id', '=', $id)
                                  ->first();

      // データ存在判定
      if(!$subject_group) {
        return redirect('/management/subject_group_list/')
                        ->withInput()
                        ->withErrors('データが存在しません。');
      }

      // 科目 削除
      $subject_group->delete();

      // リダイレクト
      return redirect('/management/subject_group_list/')
                        ->with('message', '削除しました。');
    }


/**
 * 科目メニュー
 */
    // 科目登録　画面表示
    public function pageStoreSubject(){
      $subject_groups = Subject_group::get();

      return view('kokushi.store_subject')
            ->with([
                'subject_groups'  =>  $subject_groups,
            ]);
    }

    // 科目 登録処理
    public function storeSubject(Request $request){

      // 
      $subject   =  new Subject_names();
      $subject->subject_name      = $request->subject_name;
      $subject->subject_group_id  = $request->subject_group_id;
      $subject->sight_key         = 'origin';
      $subject->created_at        = new Carbon('now');
      $subject->updated_at        = new Carbon('now');
      $subject->save();

      //
      return redirect('/kokushi/management/store_subject')
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
      $title  = new Question_titles();

      $title->subject_name_id = $request->subject_id;     // 科目ID
      $title->title_id        = $request->title_id;       // タイトルID
      $title->question_title = $request->title_name;     // 問題タイトル名
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
      $title_lists	=	Question_titles::where('subject_name_id', '=', $subject_id)
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
      $question_title	=	Question_titles::where('id', '=', $id)
                                ->first();

      $title_id         = Question_titles::select('title_id')
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
                      'title'         =>    $question_title,
                      'title_id'      =>    $title_id,
      ]);
    }

    public function updateTitle(Request $request) {
      // バリデーション

      $update_column = [
                'title_id'        =>  $request->title_id,
                'question_title'	=>  $request->question_title,
                'updated_at'      =>  new Carbon('now'),
      ];

      // 問題タイトルテーブル 更新
      Question_titles::where('id', '=', $request->id)
				->update($update_column);

      // 科目リスト 取得
      $subject_lists =  Subject_names::get();

      $subject_id       =       $request->subject_id;

      // タイトルリスト 取得
      $title_lists      =       Question_titles::where('subject_name_id', '=', $subject_id)
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
      $title  = Question_titles::where('id', '=', $id)
                                  ->first();
      if(!$title) {
        return redirect('/management/title_list/');
      }

      $subject_id = Question_titles::select('subject_name_id')
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
      $question_title  =       $request->question_title;

      // 科目ID 取得
      $subject_id       =       Subject_names::select('id')
                                          ->where('subject_name', '=', $subject_name)
                                          ->limit(1)
                                          ->value('id');

      // タイトルリスト 取得
      $title_lists	=	Question_titles::where('subject_name_id', '=', $subject_id)
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
                      'question_title'   =>  $question_title,
                      'question_number'   =>  '',
                ]);
    }

    public function showQuestionSentences(Request $request) {

      // 科目リスト 取得
      $subject_lists =  Subject_names::get();

      /*
      $subject_id       =       Subject_names::select('id')
                                        ->where('subject_name', '=', $request->subject_name)
                                        ->where('sight_key', '=', 'origin')
                                        ->value("id");
      */

      $subject_id       = $request->subject_id;

      $title_id         = $request->title_id;

      // タイトルリスト 取得
      $title_lists      =       Question_titles::where('subject_name_id', '=', $subject_id)
                                        ->where('sight_key', '=', 'origin')
                                        ->orderby('title_id', 'desc')
                                        ->get();

      $qsentences	=	Question_sentences::where('subject_id', '=', $subject_id)
                        //->where('question_title', '=', $request->question_title)
                        ->where('question_title_id', '=', $title_id)
                        ->where('sight_key', '=', 'origin')
                        ->orderby('question_number', 'asc')
                        ->get();

                        /*
      dd(
        $subject_lists,
        $title_lists,
        $subject_id,
        $request->subject_name,
        $request->question_title,
        $title_id,
        $qsentences
      );
      */

      return view('kokushi.qsentence_list')
                ->with([
                        'subjects'        =>  $subject_lists,
                        'titles'          =>  $title_lists,
                        'subject_id'      =>  $subject_id,
                        'subject_name'    =>  $request->subject_name,
                        'question_title'	=>  $request->question_title,
                        'title_id'        =>  $title_id,
                        'qsentences'      =>  $qsentences,
                ]);
    }


    // 問題文 登録
    public function storeQSentence(Request $request){

      //dd($request);

      // 科目略称 取得
      $subject_short_name = subjectClass::getShortName($request->subject_name_id);

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

      $question_sentence->question_title_id    = $request->question_title_id;     // タイトルID
      $question_sentence->question_title       = '';                               // 問題タイトル名
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
                'question_title_id'  =>  $request->question_title_id,     // タイトルID
                'question_title'     =>  '',                               // タイトル名
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

        $array_answer_sentence = 
              [
                'subject_name_id'     =>  $request->subject_name_id,        // 科目ID
                'subject_name'        =>  '',                               // 科目名
                'question_title_id'  =>  $request->question_title_id,     // タイトルID
                'question_title'     =>  '',                               // タイトル名
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
      $question_title  =       Question_titles::select('question_title')
                                                  ->where('title_id', '=', $request->question_title_id)
                                                  ->value('question_title');

      // 科目ID 取得
      $subject_id       =       $request->subject_name_id;
      /*
      $subject_id       =       Subject_names::select('id')
                                          ->where('subject_name', '=', $request->subject_name)
                                          ->limit(1)
                                          ->value('id');
*/

      // タイトルリスト 取得
      $title_lists	=	Question_titles::where('subject_name_id', '=', $subject_id)
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
                                'question_title'   =>  $question_title,
                                'question_number'   =>  $question_number,
                      ]);
    }




    /**
     * データを旧システムフォーマットから新システムフォーマットへ移行する際に使用した。
     */
    public function merge(Request $request) {

      if ($request->migration_table == 't_choices データ移行'){
        // t_choice テーブル全件取得
        $t_choices  = T_choices::get();

        foreach ($t_choices as $t_choice){

          // 科目ID・科目名 設定
          if($t_choice->ExamType == 'fe'){
            $subject_id       = 11;
            $question_title  = '基本情報技術者';

          } else if($t_choice->ExamType == 'ap'){
            $subject_id       = 12;
            $question_title  = '応用情報技術者';

          } else if($t_choice->ExamType == 'nw'){
            $subject_id       = 13;
            $question_title  = 'ネットワークスペシャリスト';

          } else if($t_choice->ExamType == 'st'){
            $subject_id       = 14;
            $question_title  = 'ITストラテジスト';

          } else if($t_choice->ExamType == 'sa'){
            $subject_id       = 15;
            $question_title  = 'システムアーキテクト';

          } else if($t_choice->ExamType == 'sm'){
            $subject_id       = 16;
            $question_title  = 'ITサービスマネージャ';

          } else if($t_choice->ExamType == 'sc'){
            $subject_id       = 17;
            $question_title  = '情報処理安全確保支援士';

          } else if($t_choice->ExamType == 'pm'){
            $subject_id       = 18;
            $question_title  = 'プロジェクトマネージャ';

          } else if($t_choice->ExamType == 'db'){
            $subject_id       = 19;
            $question_title  = 'データベーススペシャリスト';

          } else if($t_choice->ExamType == 'es'){
            $subject_id       = 20;
            $question_title  = 'エンベデッドシステムスペシャリスト';

          } else if($t_choice->ExamType == 'au'){
            $subject_id       = 21;
            $question_title  = 'システム監査技術者';

          } else if($t_choice->ExamType == 'sg'){
            $subject_id       = 22;
            $question_title  = '情報セキュリティマネジメント';

          } else if($t_choice->ExamType == 'up'){
            $subject_id       = 23;
            $question_title  = '高度区分共通';
          }

          $question_title = '';

          // 開催年 判定
          if($t_choice->Year == 'r2'){
            $question_title = '令和２年';

          } else if($t_choice->Year == 'r1'){
            $question_title = '令和元年';

          } else if($t_choice->Year == 'h31'){
            $question_title = '平成３１年';

          } else if($t_choice->Year == 'h30'){
            $question_title = '平成３０年';

          } else if($t_choice->Year == 'h29'){
            $question_title = '平成２９年';

          } else if($t_choice->Year == 'h28'){
            $question_title = '平成２８年';

          } else if($t_choice->Year == 'h27'){
            $question_title = '平成２７年';
          }

          // 季節判定
          if ($t_choice->Season == 1){
            $question_title .= '春期 ';
          } else if ($t_choice->Season == 2){
            $question_title .= '秋期 ';
          }

          // 時間帯設定
          if ($t_choice->TimeZone == 'am'){
            $question_title .= '午前';
          } else if ($t_choice->TimeZone == 'am1'){
            $question_title .= '午前１';
          } else if ($t_choice->TimeZone == 'am2'){
            $question_title .= '午前２';
          }

          $question_title_id   =   99;

          if ($question_title == '令和２年秋期 午前'){
            $question_title_id = 50;
          } else if ($question_title == '令和２年春期 午前'){
            $question_title_id = 48;
          } else if ($question_title == '令和２年春期 午前１'){
            $question_title_id = 481;
          } else if ($question_title == '令和２年春期 午前２'){
            $question_title_id = 482;
          } else if ($question_title == '令和元年秋期 午前'){
            $question_title_id = 46;
          } else if ($question_title == '令和元年秋期 午前１'){
            $question_title_id = 461;
          } else if ($question_title == '令和元年秋期 午前２'){
            $question_title_id = 462;
          } else if ($question_title == '平成３１年春期 午前'){
            $question_title_id = 44;
          } else if ($question_title == '平成３１年春期 午前１'){
            $question_title_id = 441;
          } else if ($question_title == '平成３１年春期 午前２'){
            $question_title_id = 442;
          } else if ($question_title == '平成３０年秋期 午前'){
            $question_title_id = 42;
          } else if ($question_title == '平成３０年秋期 午前１'){
            $question_title_id = 421;
          } else if ($question_title == '平成３０年秋期 午前２'){
            $question_title_id = 422;
          } else if ($question_title == '平成３０年春期 午前'){
            $question_title_id = 40;
          } else if ($question_title == '平成３０年春期 午前１'){
            $question_title_id = 401;
          } else if ($question_title == '平成３０年春期 午前２'){
            $question_title_id = 402;
          } else if ($question_title == '平成２９年秋期 午前'){
            $question_title_id = 38;
          } else if ($question_title == '平成２９年秋期 午前１'){
            $question_title_id = 381;
          } else if ($question_title == '平成２９年秋期 午前２'){
            $question_title_id = 382;
          } else if ($question_title == '平成２９年春期 午前'){
            $question_title_id = 36;
          } else if ($question_title == '平成２９年春期 午前１'){
            $question_title_id = 361;
          } else if ($question_title == '平成２９年春期 午前２'){
            $question_title_id = 362;
          } else if ($question_title == '平成２８年秋期 午前'){
            $question_title_id = 34;
          } else if ($question_title == '平成２８年秋期 午前１'){
            $question_title_id = 341;
          } else if ($question_title == '平成２８年秋期 午前２'){
            $question_title_id = 342;
          } else if ($question_title == '平成２８年春期 午前'){
            $question_title_id = 32;
          } else if ($question_title == '平成２８年春期 午前１'){
            $question_title_id = 321;
          } else if ($question_title == '平成２８年春期 午前２'){
            $question_title_id = 322;
          } else if ($question_title == '平成２７年秋期 午前'){
            $question_title_id = 30;
          } else if ($question_title == '平成２７年秋期 午前１'){
            $question_title_id = 301;
          } else if ($question_title == '平成２７年秋期 午前２'){
            $question_title_id = 302;
          } else if ($question_title == '平成２７年春期 午前'){
            $question_title_id = 28;
          } else if ($question_title == '平成２７年春期 午前１'){
            $question_title_id = 281;
          } else if ($question_title == '平成２７年春期 午前１'){
            $question_title_id = 282;
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
            $choice_sentence->subject_name_id     = $subject_id;                               // 科目ID
            $choice_sentence->subject_name        = subjectClass::getKanjiName($subject_id);   // 科目名
            $choice_sentence->question_title_id   = $question_title_id;                            // 問題タイトルID
            $choice_sentence->question_title      = $question_title;                               // 問題タイトル名
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
            $question_title  = '基本情報技術者';

          } else if($t_answer->ExamType == 'ap'){
            $subject_id       = 12;
            $question_title  = '応用情報技術者';

          } else if($t_answer->ExamType == 'nw'){
            $subject_id       = 13;
            $question_title  = 'ネットワークスペシャリスト';

          } else if($t_answer->ExamType == 'st'){
            $subject_id       = 14;
            $question_title  = 'ITストラテジスト';

          } else if($t_answer->ExamType == 'sa'){
            $subject_id       = 15;
            $question_title  = 'システムアーキテクト';

          } else if($t_answer->ExamType == 'sm'){
            $subject_id       = 16;
            $question_title  = 'ITサービスマネージャ';

          } else if($t_answer->ExamType == 'sc'){
            $subject_id       = 17;
            $question_title  = '情報処理安全確保支援士';

          } else if($t_answer->ExamType == 'pm'){
            $subject_id       = 18;
            $question_title  = 'プロジェクトマネージャ';

          } else if($t_answer->ExamType == 'db'){
            $subject_id       = 19;
            $question_title  = 'データベーススペシャリスト';

          } else if($t_answer->ExamType == 'es'){
            $subject_id       = 20;
            $question_title  = 'エンベデッドシステムスペシャリスト';

          } else if($t_answer->ExamType == 'au'){
            $subject_id       = 21;
            $question_title  = 'システム監査技術者';

          } else if($t_answer->ExamType == 'sg'){
            $subject_id       = 22;
            $question_title  = '情報セキュリティマネジメント';

          } else if($t_answer->ExamType == 'up'){
            $subject_id       = 23;
            $question_title  = '高度区分共通';
          }

          $question_title = '';

          // 開催年 判定
          if($t_answer->Year == 'r2'){
            $question_title = '令和２年';

          } else if($t_answer->Year == 'r1'){
            $question_title = '令和元年';

          } else if($t_answer->Year == 'h31'){
            $question_title = '平成３１年';

          } else if($t_answer->Year == 'h30'){
            $question_title = '平成３０年';

          } else if($t_answer->Year == 'h29'){
            $question_title = '平成２９年';

          } else if($t_answer->Year == 'h28'){
            $question_title = '平成２８年';

          } else if($t_answer->Year == 'h27'){
            $question_title = '平成２７年';
          }

          // 季節判定
          if ($t_answer->Season == 1){
            $question_title .= '春期 ';
          } else if ($t_answer->Season == 2){
            $question_title .= '秋期 ';
          }

          // 時間帯設定
          if ($t_answer->TimeZone == 'am'){
            $question_title .= '午前';
          } else if ($t_answer->TimeZone == 'am1'){
            $question_title .= '午前１';
          } else if ($t_answer->TimeZone == 'am2'){
            $question_title .= '午前２';
          }

          $question_title_id   =   99;

          if ($question_title == '令和２年秋期 午前'){
            $question_title_id = 50;
          } else if ($question_title == '令和２年春期 午前'){
            $question_title_id = 48;
          } else if ($question_title == '令和２年春期 午前１'){
            $question_title_id = 481;
          } else if ($question_title == '令和２年春期 午前２'){
            $question_title_id = 482;
          } else if ($question_title == '令和元年秋期 午前'){
            $question_title_id = 46;
          } else if ($question_title == '令和元年秋期 午前１'){
            $question_title_id = 461;
          } else if ($question_title == '令和元年秋期 午前２'){
            $question_title_id = 462;
          } else if ($question_title == '平成３１年春期 午前'){
            $question_title_id = 44;
          } else if ($question_title == '平成３１年春期 午前１'){
            $question_title_id = 441;
          } else if ($question_title == '平成３１年春期 午前２'){
            $question_title_id = 442;
          } else if ($question_title == '平成３０年秋期 午前'){
            $question_title_id = 42;
          } else if ($question_title == '平成３０年秋期 午前１'){
            $question_title_id = 421;
          } else if ($question_title == '平成３０年秋期 午前２'){
            $question_title_id = 422;
          } else if ($question_title == '平成３０年春期 午前'){
            $question_title_id = 40;
          } else if ($question_title == '平成３０年春期 午前１'){
            $question_title_id = 401;
          } else if ($question_title == '平成３０年春期 午前２'){
            $question_title_id = 402;
          } else if ($question_title == '平成２９年秋期 午前'){
            $question_title_id = 38;
          } else if ($question_title == '平成２９年秋期 午前１'){
            $question_title_id = 381;
          } else if ($question_title == '平成２９年秋期 午前２'){
            $question_title_id = 382;
          } else if ($question_title == '平成２９年春期 午前'){
            $question_title_id = 36;
          } else if ($question_title == '平成２９年春期 午前１'){
            $question_title_id = 361;
          } else if ($question_title == '平成２９年春期 午前２'){
            $question_title_id = 362;
          } else if ($question_title == '平成２８年秋期 午前'){
            $question_title_id = 34;
          } else if ($question_title == '平成２８年秋期 午前１'){
            $question_title_id = 341;
          } else if ($question_title == '平成２８年秋期 午前２'){
            $question_title_id = 342;
          } else if ($question_title == '平成２８年春期 午前'){
            $question_title_id = 32;
          } else if ($question_title == '平成２８年春期 午前１'){
            $question_title_id = 321;
          } else if ($question_title == '平成２８年春期 午前２'){
            $question_title_id = 322;
          } else if ($question_title == '平成２７年秋期 午前'){
            $question_title_id = 30;
          } else if ($question_title == '平成２７年秋期 午前１'){
            $question_title_id = 301;
          } else if ($question_title == '平成２７年秋期 午前２'){
            $question_title_id = 302;
          } else if ($question_title == '平成２７年春期 午前'){
            $question_title_id = 28;
          } else if ($question_title == '平成２７年春期 午前１'){
            $question_title_id = 281;
          } else if ($question_title == '平成２７年春期 午前１'){
            $question_title_id = 282;
          }

          // 問題番号
          $question_number  = $t_answer->QuestionNumber;

          // 正答1  取得
          $answer_sentence1                        = $t_answer->Answer1;

          // 選択肢テーブル 基本情報設定
          $answer_sentence = new Answer_sentences();
          $answer_sentence->subject_name_id     = $subject_id;                                    // 科目ID
          $answer_sentence->subject_name        = subjectClass::getKanjiName($subject_id);   // 科目名
          $answer_sentence->question_title_id   = $question_title_id;                            // 問題タイトルID
          $answer_sentence->question_title      = $question_title;                               // 問題タイトル名
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
