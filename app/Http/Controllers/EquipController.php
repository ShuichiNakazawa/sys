<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\M_dept;
use App\M_equipment;
use App\User;

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

    // 新規ユーザ登録画面 表示前処理
    public function showUser(){

        // ログインユーザの権限・部門によって、取得するユーザ一覧を変える
        if(Auth::user()->privilege_access == 1){

            // 総合管理者
            $users  =   User::get();

        } else if(Auth::user()->privilege_access == 1){

            // 部門管理者
            $users  =   User::where('dept_id', '=', Auth::user()->dept_id)
                            ->get();
        } else {

            // 一般ユーザ、もしくは権限無し
            $users  =   '';
        }

        // ログインユーザを取得
        $login_user =   User::find(Auth::user()->id);

        return view('sample.equip.register_user')
            ->with([
                // 
                'login_user'    =>  $login_user,
                'users'         =>   $users,
                'depts'         =>   M_dept::get(),
            ]);
    }

    public function registerUser(Request $request){

        $user       =   new User();
        // 画面（リクエスト）から値を取得
        $user->account_id           =   $request->account_ID;
        $user->name                 =   $request->user_name;
        $user->dept_id              =   $request->dept_id;
        $user->privilege_access     =   $request->privilege;
        $user->save();

    }
}
