<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    //テンプレート インデックス表示
    public function showIndex(){

        //
        return view('template.index');
    }
}
