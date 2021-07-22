<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\musatra_comments;
use App\musatra_files;
//use App\;

class MusatrasamaController extends Controller
{
    //
    public function showIndex(){

        // テーブル項目　取得
        // コメントテーブル
        $comments   =   musatra_comments::get();

        // ファイルテーブル
        $files      =   array();
        $index = 1;

        foreach($comments as $comment ){
            $files[$index]  =   musatra_files::where('comment_id', '=', $comment->id)
                                            ->orderby('comment_id', 'desc')
                                            ->orderby('file_id', 'asc')
                                            ->get();

            //$comment->
            $index++;
        }

        return view('test.musatrasama.index')
                    ->with([
                        'comments'  =>   $comments,
                        'files'     =>   $files,
                    ]);

    }
}
