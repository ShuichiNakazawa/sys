<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\M_dept;
use App\M_equipment;
use App\t_equip_stock;

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

    public function referEquipment(){

        // ログインユーザの権限によって、取得する備品を変更する。
        if(Auth::user()->privilege_access == 1){

            // 全件取得
            $equipments =   M_equipment::get();

            // 

        } else if(Auth::user()->privilege_access == 2
             ||   Auth::user()->privilege_access == 3  ){

            // 部門限定取得
            $equipments =   M_equipment::where('m_dept_id', '=', Auth::user()->m_dept_id)
                                        ->get();

        }

        //dd(Auth::user()->privilege_access);

        return view('sample.equip.refer_equip')
                    ->with([
                        'equipments'    =>  $equipments,
                    ]);
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

    /**
     * 備品マスタ 登録処理
     * * * * * *
     * 備品マスタ及び備品在庫テーブルへ登録処理を行う。
     */ 

    public function registerM_equip(Request $request) {

        // 備品情報バリデーション

        // 備品マスタ 登録
        $m_equip =   new M_equipment();
        $m_equip->name_of_equipment         =  $request->name_of_equip;
        $m_equip->m_dept_id                 =  $request->dept_id;
        $m_equip->image_name                =  "";
        $m_equip->notification_min_value    =  $request->notification_min_value;
        //$m_equip->datetime_alert            =  "";

        // 登録
        $m_equip->save(); 

        // 備品マスタ ID取得
        $equip_id   =   M_equip::select('id')
                                ->where('name_of_equipment', '=', $request->name_of_equip)
                                ->limit(1)
                                ->value('id');

        // 備品在庫テーブル 登録
        $equip_stock                    =   new T_equip_stock();
        $equip_stock->id                =   $equip_id;
        $equip_stock->equipment_id      =   $equip_id;
        $equip_stock->stock_quantity    =   0;

        // 登録
        $equip_stock->save();

        return view('sample.equip.register_m_equip')
                    ->with([
                        'depts'         =>   M_dept::get(),
                        'equipments'    =>   M_equipment::with('M_depts')->get(),
                    ]);
    }

    // 新規ユーザ登録画面 表示前処理
    public function showUser(){

        // ログインユーザの権限・部門によって、取得するユーザ一覧を変える
        if(Auth::user()->privilege_access == 1){

            // 総合管理者
            $users  =   User::get();

        } else if(Auth::user()->privilege_access == 2){

            // 部門管理者
            $users  =   User::where('m_dept_id', '=', Auth::user()->m_dept_id)
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

        // バリデーション

        $user       =   new User();
        // 画面（リクエスト）から値を取得
        $user->login_id             =   $request->login_id;
        $user->name                 =   $request->user_name;
        $user->password             =   Hash::make($request->password);
        $user->m_dept_id            =   $request->dept_id;
        $user->privilege_access     =   $request->privilege;
        $user->save();

        // ログインユーザの権限・部門によって、取得するユーザ一覧を変える
        if(Auth::user()->privilege_access == 1){

            // 総合管理者
            $users  =   User::get();

        } else if(Auth::user()->privilege_access == 2){

            // 部門管理者
            // 自分以外の部門管理者を除外したい。ロジック追加が必要
            $users  =   User::where('m_dept_id', '=', Auth::user()->m_dept_id)
                            ->get();
                            
        } else {

            // 一般ユーザ、もしくは権限無し
            $users  =   '';
        }

        // ログインユーザを取得
        $login_user =   User::find(Auth::user()->id);

        // フラッシュメッセージ 設定
        session()->flash('message', '正常に登録できました。');

        return view('sample.equip.register_user')
            ->with([
                // 
                'login_user'    =>  $login_user,
                'users'         =>   $users,
                'depts'         =>   M_dept::get(),
            ]);
    }


    // 備品在庫確認画面 表示
    public function showEquip(Request $request)
    {
        // 権限によって、取得する備品情報を変える。
        if(Auth::user()->privilege_access == 1){

            // 総合管理者
            $depts      =   M_dept::get();
            $equipments =   M_equipment::get();
            $stocks     =   T_equip_stock::get();

        } else if (Auth::user()->privilege_access == 2){

            // 部門管理者
            $depts      =   M_dept::where('id', '=', Auth::user()->m_dept_id)
                                    ->get();
            $equipments =   M_equipment::where('m_dept_id', '=', Auth::user()->m_dept_id)
                                    ->get();

            // 紐づくM_equipmentの部門IDと一致するレコードだけ取得したい（取得条件が外部テーブルにある）
            $stocks     =   select("select * from T_equip_stock where id in (select id from m_equipment where m_dept_id = " . Auth::user()->m_dept_id . ")");
            //$stocks     =   T_equip_stock::where

            // select * from T_equip_stock where id in select id from m_equipment where m_dept_id = 
        }


        // 備品マスタを読み込み、備品登録画面を表示
        return view('sample.equip.register_m_equip')
                    ->with([
                        'depts'         =>   $depts,
                        'equipments'    =>   $equipments,
                        'stocks'        =>   $stocks,
                    ]);

    }

    // 備品マスタ取得
    public function getM_equip() {
                // 権限によって、取得する備品情報を変える。
                if(Auth::user()->privilege_access == 1){

                    // 総合管理者
                    $depts      =   M_dept::get();
                    $equipments =   M_equipment::get();
                    $stocks     =   T_equip_stock::get();
        
                } else if (Auth::user()->privilege_access == 2){
        
                    // 部門管理者
                    $depts      =   M_dept::where('id', '=', Auth::user()->m_dept_id)
                                            ->get();
                    $equipments =   M_equipment::where('m_dept_id', '=', Auth::user()->m_dept_id)
                                            ->get();
        
                    // 紐づくM_equipmentの部門IDと一致するレコードだけ取得したい（取得条件が外部テーブルにある）
                    $stocks     =   select("select * from T_equip_stock where id in (select id from m_equipment where m_dept_id = " . Auth::user()->m_dept_id . ")");
                    //$stocks     =   T_equip_stock::where
        
                    // select * from T_equip_stock where id in select id from m_equipment where m_dept_id = 
                }
        
        
                // 備品マスタを読み込み、備品登録画面を表示
                return view('sample.equip.edit_m_equip')
                            ->with([
                                'depts'         =>   $depts,
                                'equipments'    =>   $equipments,
                                'stocks'        =>   $stocks,
                            ]);
        
    }

    //
    public function editM_equip(Request $request){
        //画面入力項目 取得

    }

    // 備品入出庫庫 編集画面 表示
    public function referInout(){
        // 権限によって、取得する備品情報を変える。
        if(Auth::user()->privilege_access == 1){

            // 総合管理者
            $depts      =   M_dept::get();
            $equipments =   M_equipment::get();

        } else if (Auth::user()->privilege_access == 2
                || Auth::user()->privilege_access == 3 ){

            // 部門管理者
            $depts      =   M_dept::where('id', '=', Auth::user()->m_dept_id)
                                    ->get();
            $equipments =   M_equipment::where('m_dept_id', '=', Auth::user()->m_dept_id)
                                    ->get();

        }

        // 備品マスタを読み込み、備品登録画面を表示
        return view('sample.equip.inout_management')
                    ->with([
                        'depts'         =>   $depts,
                        'equipments'    =>   $equipments,
                    ]);
    }

    public function referUser(){

        // ログインユーザの権限・部門によって、取得するユーザ一覧を変える
        if(Auth::user()->privilege_access == 1){

            // 総合管理者
            $users  =   User::get();

        } else if(Auth::user()->privilege_access == 2){

            // 部門管理者
            $users  =   User::where('m_dept_id', '=', Auth::user()->m_dept_id)
                            ->get();
        } else {

            // 一般ユーザ、もしくは権限無し
            $users  =   '';
        }

        // ログインユーザを取得
        $login_user =   User::find(Auth::user()->id);

        return view('sample.equip.refer_user')
            ->with([
                // 
                'login_user'    =>  $login_user,
                'users'         =>   $users,
                'depts'         =>   M_dept::get(),
            ]);
    }
}
