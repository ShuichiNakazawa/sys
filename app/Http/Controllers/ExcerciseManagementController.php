<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcerciseManagementController extends Controller
{
    // 管理画面トップページ
    public function showIndex(){
        
        // 
        return view('kokushiManagement.index');
    }
}
