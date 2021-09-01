<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\subjectClass;
use App\Question_titles;

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

    // ランダム演習 開始
    public function startRandomExcercise() {

    }

    // 年度指定演習 開始
    public function startSelectedExcercise() {
        
    }
}
