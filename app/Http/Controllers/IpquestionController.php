<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subject;
use App\Title;
use App\Question_sentence;
use App\Choice_sentence;
use App\Answer_sentence;
use App\Test_score;

//use App\Individual_info;   // ユーザによる個々の問題への操作情報を保存したテーブル
use App\Individual_score;

use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class IpquestionController extends Controller
{
    //
    public function showIndex(){
        $subject_names  =   Subject::where('subject_group_id', '=', 2)
                                            ->get();

        $index = 0;
        $titles = array();

        foreach($subject_names as $subject){
            $work_titles = Title::where('subject_id', '=', $subject->id)
                                        ->orderby('title_id', 'desc')
                                        ->get();
            //$subject->id
            $titles[$index] =   $work_titles;
            $index++;

        }

        return view('ipquestion.index')
                        ->with([
                            'subjects'  =>  $subject_names,
                            'titles'    =>  $titles,
                        ]);
    }

    public function selectMenu(Request $request){

        $subject_id =   $request->subject_id;
        $title_id   =   $request->title_id;

        //取得項目確認
        //dd($request->title_id, $request->selected_menu);

        // 選択メニュー判定
        if($request->selected_menu == 1){

            // 問題文リスト　表示

            // 問題文　取得
            $questions  =   Question_sentence::where('subject_id', '=', $request->subject_id)
                                                ->where('title_id', '=', $request->title_id)
                                                ->orderby('question_number', 'asc')
                                                ->get();
            return view('ipquestion.question_list')
                ->with([
                    'subject_id'    =>  $request->subject_id,
                    'title_id'      =>  $request->title_id,
                    'questions' =>  $questions,

                ]);

        } elseif ($request->selected_menu == 2){

            // 試験　実施

            // テストデータ設定
            $user_id = 1;

            // 必要な処理
            // 各問題に対する回答内容を進行中テストテーブルに保存
            // 

            // 試験得点テーブル　登録
            $test_score             =   new Test_score();
            $test_score->user_id    =   $user_id; // Auth()->idate
            $test_score->subject_id =   $request->subject_id;
            $test_score->title_id   =   $request->title_id;

            // 実施回数　取得
            $work_number_try   =   Test_score::select('number_try')
                                                ->where('user_id', '=', $user_id)
                                                ->where('subject_id', '=', $request->subject_id)
                                                ->where('title_id', '=', $request->title_id)
                                                ->orderby('number_try', 'desc')
                                                ->limit(1)
                                                ->value('number_try');

            $work_number_try++;

            $test_score->number_try    =   $work_number_try;
            $test_score->score          =   0;
            $test_score->sight_key      =   'origin';
            $test_score->created_at     =   new Carbon('now');
            $test_score->updated_at     =   new Carbon('now');
            $test_score->save();

            // 試験得点テーブル ID　取得
            $work_id    =   Test_score::select('id')
                                        ->where('user_id', '=', $user_id)
                                        ->where('subject_id', '=', $request->subject_id)
                                        ->where('title_id', '=', $request->title_id)
                                        ->where('number_try', '=', $work_number_try)
                                        ->value('id');



            // セッションへ各項目を登録
            // 試験得点ID は $work_id


            // 試験ページのURLへリダイレクト
            return redirect('/test/' . $request->subject_id . '/' . $title_id . '/1');


        } elseif ($request->selected_menu == 3){
            
            // 統計情報　表示

        }


    }

    // 開催年度リスト　表示
    public function showList(Request $request, $subject_id) {

        //タイトルリスト　取得
        $titles =   Title::where('subject_id', '=', $subject_id)
                            ->orderby('title_id', 'desc')
                            ->get();

        //dd($titles);

        return view('ipquestion.titleList')
                            ->with([
                                'subject_id'    =>  $subject_id,
                                'titles'        =>  $titles,
                            ]);

    }

    public function showTest(){
        dd('テスト');
    }


    // 指定された科目・タイトルの問題文リストを表示する
    public function showQuestionList(Request $request, $subject_id, $title_id) {

        // 問題文　取得
        $questions =   Question_sentence::where('subject_id', '=', $subject_id)
                                                    ->where('title_id', '=', $title_id)
                                                    ->orderby('question_number', 'asc')
                                                    ->get();

        return view('ipquestion.question_list')
                    ->with([
                        'subject_id'        =>  $subject_id,
                        'title_id'          =>  $title_id,
                        'questions'         =>  $questions,
                    ]);

    }

    // 問題文　個別表示
    public function showQuestion(Request $request, $subject_id, $title_id, $question_number){

        // 科目名称　取得
        $subject_name   =   Subject::select('subject_name')
                                        ->where('id', '=', $subject_id)
                                        ->value('subject_name');
                                        

        // タイトル名称　取得
        $question_title  =   Title::select('question_title')
                                        ->where('subject_id', '=', $subject_id)
                                        ->where('title_id', '=', $title_id)
                                        ->value('question_title');

        //問題文レコード　取得
        $question_sentence  =   Question_sentence::where('subject_id', '=', $subject_id)
                                                    ->where('title_id', '=', $title_id)
                                                    ->where('question_number', '=' , $question_number)
                                                    ->limit(1)
                                                    ->get();

        //dd($question_sentence);

        // 選択肢　取得
        $choice_sentences   =   Choice_sentence::where('subject_id', '=', $subject_id)
                                                    ->where('title_id', '=', $title_id)
                                                    ->where('question_number', '=' , $question_number)
                                                    ->get();

        // 正答文　取得
        $answer_sentences   =   Answer_sentence::where('subject_id', '=', $subject_id)
                                                    ->where('title_id', '=', $title_id)
                                                    ->where('question_number', '=' , $question_number)
                                                    ->get();


        $individual_scores          =   '';

        // 選択肢文字列　設定
        $array_choices  =   ['ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ'];

        return view('ipquestion.question')
            ->with([
                'subject_name'          =>  $subject_name,          // 科目名称
                'question_title'        =>  $question_title,        // タイトル名称
                'question_number'       =>  $question_number,       // 問題番号
                'question_sentence'     =>  $question_sentence,     // 問題文
                'choice_sentences'      =>  $choice_sentences,      // 選択肢
                'answer_sentences'      =>  $answer_sentences,      // 正答
                'individual_scores'     =>  $individual_scores,     // 正誤
                'array_choices'         =>  $array_choices,         // 選択肢文字　配列
            ]);


    }

    // テスト文章　設定
    public function setTest(Request $request, $subject_id, $title_id, $question_number){

        // 各テーブルから、テストのための情報を取得
        $subject_name       =   '';         // 科目名
        $question_title     =   '';         // タイトル名
        
        // セッション（問題番号）　更新
        $request->session()->put('question_number', $question_number);

        // 問題文テーブル　取得
        $question_sentence  =   Question_sentence::where('subject_id', '=', $subject_id)
                                                    ->where('title_id', '=', $title_id)
                                                    ->where('question_number', '=', $question_number)
                                                    ->first();
                                                    /*
                                                    ->limit(1)
                                                    ->get();
                                                        */

        // 最終問題番号　取得
        $last_question_number   =   Question_sentence::where('subject_id', '=', $subject_id)
                                                    ->where('title_id', '=', $title_id)
                                                    ->orderby('question_number', 'desc')
                                                    ->limit(1)
                                                    ->get();


        // 選択肢文　取得
        $choice_sentences   =   Choice_sentence::where('subject_id', '=', $subject_id)
                                                    ->where('title_id', '=', $title_id)
                                                    ->where('question_number', '=', $question_number)
                                                    ->get();

        // 正答文　取得
        $answer_sentences   =   Answer_sentence::where('subject_id', '=', $subject_id)
                                                    ->where('title_id', '=', $title_id)
                                                    ->where('question_number', '=', $question_number)
                                                    ->get();

        // 選択肢文字列　設定
        $array_choices  =   ['ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ'];   


        // 
        return view('ipquestion.test')
                        ->with([
                            'subject_id'        =>      $subject_id,
                            'subject_name'      =>      $subject_name,
                            'title_id'          =>      $title_id,
                            'question_title'    =>      $question_title,
                            'question_number'   =>      $question_number,
                            'question_sentence' =>      $question_sentence,
                            'choice_sentences'  =>      $choice_sentences,
                            'array_choices'     =>      $array_choices,
                            'answer_sentences'  =>      $answer_sentences,
                            'last_question_number'  =>  $last_question_number,
                        ]);

    }



}
