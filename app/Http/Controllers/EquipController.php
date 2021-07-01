<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\M_dept;
use App\M_equipment;
use App\Users;

use Auth;

class EquipController extends Controller
{
    public function __construct(){

        // セッション設定
        // セッションへ一つのデータを保存する
        session(['sight_key' => 'equipment']);

        // 認証機能
        $this->middleware('auth');
    }

    // メニュー表示
    public function showMenu() {
        return view('sample.equip.index');
    }

    // 部門マスタ登録画面 表示準備
    public function showDepts() {

        // 部門テーブルを読み込み、部門登録画面を表示
        return view('sample.equip.register_m_dept')
                    ->with([
                        'depts'  =>   M_dept::get(),
                    ]);
    }

    // 部門マスタ 登録処理
    public function registerDept(Request $request)
    {

        // 部門名バリデーション

        $m_dept =   new M_dept();
        $m_dept->name_of_dept   =  $request->name_of_dept;
        $m_dept->editor         =   "";
        $m_dept->save(); 

        return view('sample.equip.register_m_dept')
                    ->with([
                        'depts'  =>   M_dept::get(),
                    ]);
    }

    // 備品マスタ画面 表示
    public function showEquip(Request $request)
    {
        // 備品マスタを読み込み、備品登録画面を表示
        return view('sample.equip.register_m_equip')
                    ->with([
                        'depts'  =>   M_dept::get(),
                        'equipments'  =>   M_equipment::get(),
                    ]);

    }

    // 備品マスタ 登録処理
    public function registerM_equip(Request $request) {

        // 備品情報バリデーション

        $m_equip =   new M_equipment();
        $m_equip->name_of_equipment         =  $request->name_of_equip;
        $m_equip->dept_id                   =  $request->dept_id;
        $m_equip->image_name                =  "";
        $m_equip->notification_min_value    =  $request->notification_min_value;
        //$m_equip->datetime_alert            =  "";

        $m_equip->save(); 

        return view('sample.equip.register_m_equip')
                    ->with([
                        'depts'  =>   M_dept::get(),
                        'equipments'  =>   M_equipment::get(),
                    ]);
    }
}
