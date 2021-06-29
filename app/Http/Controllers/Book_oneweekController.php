<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book_oneweek;

class Book_oneweekController extends Controller
{
    //
    function index() {
        # bookテーブルに入っているデータを全てとってくる
        $books = Book_oneweek::all();

        # 使うビューファイルを指定
        # compactにはビューファイルに送るデータを選択
        return view("sample.oneweek.index", compact("books"));
    }
}
