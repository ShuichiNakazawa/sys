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

        // 科目ID から科目名を取得
        $subject_name = subjectClass::getKanjiName($subject_id);

        // 科目IDに紐づくタイトルIDを取得
        $titles =   Question_titles::where('subject_name_id', '=', $subject_id)
                            ->where('sight_key', '=', "origin")
                            ->orderby('title_id', 'DESC')
                            ->get();

        // 

        return view('excercise.menu')
                    ->with([
                        'subject_id'    =>  $subject_id,        // 科目ID
                        'subject_name'  =>  $subject_name,      // 科目名
                        'titles'        =>  $titles,            // タイトル配列
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
                                                    ->get();

            // 正答文 取得
            $answerSentences = Answer_sentences::where('subject_name_id', '=', $subject_id)
                                                    ->where('question_title_id', '=', $param)
                                                    ->where('sight_key', '=', "origin")
                                                    ->get();

            // ログイン判定
            if(Auth::user() !== null){
                // 回答履歴取得
                $corrects   =   ""; // 省略
            } else {
                $corrects   = "";   // ゲストユーザ。履歴は無し
            }


            $retVal = [
                $questionSentences,
                $choiceSentences,
                $answerSentences,
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