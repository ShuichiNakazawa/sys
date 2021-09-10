<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\subjectClass;
use App\Question_titles;
use App\Question_sentences;
use App\Choice_sentences;
use App\Answer_sentences;

use Auth;

class ExcerciseController extends Controller
{
    // メニュー表示
    public function showMenu($subject_id){

        // 進捗バー項目 初期化
        $numberPerfect  =   0;
        $numberStable   =   0;
        $numberGood     =   0;
        $numberBad      =   0;
        $numberNoLook   =   0;

        // 科目ID から科目名を取得
        $subject_name = subjectClass::getKanjiName($subject_id);

        // 科目IDに紐づくタイトルIDを取得
        $titles =   Question_titles::where('subject_name_id', '=', $subject_id)
                            ->where('sight_key', '=', "origin")
                            ->orderby('title_id', 'DESC')
                            ->get();

        /* 20210910 修正開始 */

        // ログイン判定
        if(Auth::user() !== null){

            // ログイン済
            // 進捗バー表示項目 取得

            /* SQL を修正 */
            $checkRecords = Individual_scores::where('where user_id', '=', Auth::user()->id)
                            ->where('subject_name_id', '=', $subject_id)
                            ->distinct()
                            ->select('subject_name_id',                 // 科目ID
                                    'question_title_id',                // タイトルID
                                    'question_number',                  // 問題番号
                                    'number_try')                       // 挑戦回数
                            ->orderby('question_title_id', 'ASC')
                            ->orderby('question_number', 'ASC')
                            ->orderby('number_try', 'ASC')
                            ->get();

            // ①科目の問題数 - 上記配列の件数を No_look の件数として保存。

            // 該当科目の問題数
            $numberQuestionPerSubject = Question_sentences::where('subject_name_id', '=', $subject_id)
                                                    ->where('sight_key', '=', 'origin')
                                                    ->count();

            // 挑戦済みの問題数を算出
            $numberQuestionTried = Individual_scores::where('user_id', '=', Auth::user()->id)
                                        ->distinct()
                                        ->select(   'subject_name_id'
                                                ,   'question_title_id'
                                                ,   'question_number')
                                        ->count();


            // No look の件数 算出
            $numberNoLook = $numberQuestionPerSubject - $numberQuestionTried;


            foreach($checkRecords as $record){

                // 問題１問・挑戦回数ごとの処理

                // 同一問題に対して
                // 最後が連続５回正解ならPerfectにカウント
                // 挑戦回数が小さい順に５件を取得し、全てが正解であれば Perfect に該当
                $checkPerfect = Individual_scores::where( 'subject_id', '=', $subject_id )
                        ->where('question_title_id', '=', $record->question_title_id) 
                        ->where('question_number', '=', $record->question_number)
                        ->where('user_id', '=', $record->user_id)
                        ->orderby('number_try', 'desc')
                        ->limit(5)
                        ->get();

                // 問題番号ごとの正解数
                $numPerfectPerQuestion = 0;

                foreach($checkPerfect as $perf){

                    // 正解判定
                    if($perf->judgement == 1){

                        // 正解数 加算
                        $numPerfectPerQuestion++;
                    }
                }

                // 最新５件 正解判定
                if($numPerfectPerQuestion == 5){

                    // Perfect数 加算
                    $numberPerfect++;

                } else {
                    // 最後が連続３回正解ならStableにカウント

                    $checkStable = Individual_scores::where('subject_name_id', '=', $subject_id) 
                            ->where('question_title_id', '=', $record->question_title_id) 
                            -where('question_number', '=', $record->question_number)
                            ->where('user_id', '=', $record->user_id)
                            ->orderby('number_try', 'desc')
                            ->limit(3)
                            ->get();

                    $numStablePerQuestion = 0;

                    foreach($checkStable as $stable){

                        if($stable->judgement == 1){

                            $numStablePerQuestion++;
                        }
                    }

                    if($numStablePerQuestion == 3){

                        // Stable 加算
                        $numberStable++;

                    } else {
                        // 上の条件を満たさず、
                        // 正解が１回以上あり、過去５回で正解の数と不正解の数が一致か、正解の数の方が多い場合にGood

                        $checkGood = Individual_scores::where('subject_id', '=', $subject_id)
                                ->where('question_title_id', '=', $record->question_title_id) 
                                ->where('question_number', '=', $record->question_number)
                                ->where('user_id', '=', $user_id)
                                ->orderby('number_try', 'desc')
                                ->limit(3)
                                ->get();

                        $numGoodPerQuestion = 0;            // 問題番号・挑戦回数ごとのGood数
                        $numNotGoodPerQuestion = 0;         // 問題番号・挑戦回数ごとのBad数

                        foreach($checkGood as $good){

                            // 正答判定
                            if($good->judgement == 1){

                                // 正解数 加算
                                $numGoodPerQuestion++;

                            } else {

                                // 不正解数 加算
                                $numNotGoodPerQuestion++;
                            }
                        }

                        if(     $numGoodPerQuestion > 0
                            &&  $numGoodPerQuestion >= $numNotGoodPerQuestion
                        ){

                            // Good数 加算
                            $numberGood++;

                        } else {

                            // 不正解の数の方が正解の数より多い

                            // Bad数 加算
                            $numberBad++;

                        }
                    }



                }


            }

        } else {

            // ゲストユーザ
            $corrects   = "";   // ゲストユーザ。履歴は無し
        }



        return view('excercise.menu')
                    ->with([
                        'subject_id'    =>  $subject_id,        // 科目ID
                        'subject_name'  =>  $subject_name,      // 科目名
                        'titles'        =>  $titles,            // タイトル配列

                        'numberPerfect' =>  $numberPerfect,     // Perfectの数
                        'numberStable'  =>  $numberStable,      // Stableの数
                        'numberGood'    =>  $numberGood,        // Goodの数
                        'numberBad'     =>  $numberBad,         // Badの数
                        'numberNoLook'  =>  $numberNoLook,      // No Lookの数
                    ]);

    }

    // 問題文 出力API
    public function setQuestionInfo($subject_id, $questionMode, $param) {

        // 出題モードによって処理を変える
        if($questionMode == 'get_random'){

            // ランダム出題モード（第３引数は出題する問題数）
            // 対象となる問題をランダム抽選
            $questionSentences = Question_sentences::where('subject_id', '=', $subject_id)
                                                        ->where('sight_key', '=', "origin")
                                                        ->get();

        } else if($questionMode == 'get_title'){

            // 年度指定出題モード（第３引数はタイトルID）
            // 対象となる問題を科目・タイトルで取得
            // 問題文 取得
            $questionSentences = Question_sentences::where('subject_id', '=', $subject_id)
                                                    ->where('question_title_id', '=', $param)
                                                    ->where('sight_key', '=', "origin")
                                                    ->get();

            // 選択肢文 取得
            $choiceSentences = Choice_sentences::where('subject_name_id', '=', $subject_id)
                                                    ->where('question_title_id', '=', $param)
                                                    ->where('sight_key', '=', "origin")
                                                    ->orderby('question_number', 'ASC')
                                                    ->orderby('choice_id', 'ASC')
                                                    ->get();

            // 現状では問題番号に関係なく、０から順に配列へ保存されてしまう。
            // 問題番号ごとの配列として保存したい。

            // ①for文で取得し、回しながら新規配列へ格納する

            $old_question_number = 1;
            $array_choiceSentencesPerQuestion = [];
            $index_array = 0;

            // 問題番号ごとに格納し直す
            foreach($choiceSentences as $choice){

                if($old_question_number != $choice->question_number){
                    $array_choiceSentencesPerQuestion[] = $work_array;
                    $work_array = [];
                    $index_array = 0;

                    $old_question_number = $choice->question_number;
                }

                $work_array[$index_array]['choice_id']        = $choice->choice_id;
                $work_array[$index_array]['choice_sentence']  = $choice->choice_sentence;

                $index_array++;

                // 問題番号が変わるまで、１つの配列へ選択肢文を追加していく

            }

            $array_choiceSentencesPerQuestion[] = $work_array;


            // 正答文 取得
            $answerSentences = Answer_sentences::where('subject_name_id', '=', $subject_id)
                                                    ->where('question_title_id', '=', $param)
                                                    ->where('sight_key', '=', "origin")
                                                    ->orderby('question_number', 'ASC')
                                                    ->orderby('answer_id', 'ASC')
                                                    ->get();


            $old_question_number = 1;
            $array_answerSentencesPerQuestion = [];
            $index_array = 0;

            // 問題番号ごとに格納し直す
            foreach($answerSentences as $answer){

                if($old_question_number != $answer->question_number){
                    $array_answerSentencesPerQuestion[] = $work_array;
                    $work_array = [];
                    $index_array = 0;

                    $old_question_number = $answer->question_number;
                }

                $work_array[$index_array]['answer_id']        = $answer->answer_id;
                $work_array[$index_array]['answer_sentence']  = $answer->answer_sentence;

                $index_array++;

                // 問題番号が変わるまで、１つの配列へ選択肢文を追加していく

            }

            $array_answerSentencesPerQuestion[] = $work_array;


            // ログイン判定
            if(Auth::user() !== null){
                // 回答履歴取得
                $corrects   =   ""; // 省略
            } else {
                $corrects   = "";   // ゲストユーザ。履歴は無し
            }


            $retVal = [
                $questionSentences,
                $array_choiceSentencesPerQuestion,
                $array_answerSentencesPerQuestion,
                //$answerSentences,
                $corrects
            ];

            $retVal = json_encode($retVal);

            return $retVal;
            /*
            return view('excercise.setJson')
                    ->with([
                        'retVal'  =>  $retVal,
                    ]);
            */
        }
    }

    // ランダム演習 開始
    public function startRandomExcercise() {

    }

    // 年度指定演習 開始
    public function startSelectedExcercise() {
        
    }
}
