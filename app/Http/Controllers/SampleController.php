<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class SampleController extends Controller
{

    /**
     * p5.js　インデックス
     */
    public function p5_index(){
        return view('sample.p5.index');
    }

    /**
     * 棒グラフ
     */
    public function showBar_graph(){
        return view('sample.p5.bar_graph');
    }

    /**
     * ブロック崩し
     */
    public function showBreak_block(){
        return view('sample.p5.break_block');
    }

    //

    public function beforeStripe(Request $request) {

        // 該当ユーザによる仮注文レコードを削除

        //return redirect('/checkout');

        //dd($request);

        // 15分チケット数 取得
        $quantity_item1     =   $request->quantity_item1;
        $quantity_item2     =   $request->quantity_item2;
        $quantity_item3     =   $request->quantity_item3;
        $quantity_item4     =   $request->quantity_item4;
        $quantity_item5     =   $request->quantity_item5;

        $quantity_item6     =   $request->quantity_item6;
        $quantity_item7     =   $request->quantity_item7;
        $quantity_item8     =   $request->quantity_item8;
        $quantity_item9     =   $request->quantity_item9;
        $quantity_item10     =   $request->quantity_item10;

        $quantity_item11     =   $request->quantity_item11;
        $quantity_item12     =   $request->quantity_item12;
        $quantity_item13     =   $request->quantity_item13;
        $quantity_item14     =   $request->quantity_item14;
        $quantity_item15     =   $request->quantity_item15;

        $array_product  =   array();

        // validator

        // 仮注文レコード 登録

        // 下記処理は、データをテーブルに格納したうえで、取得しながら表示させるよう変更が可能。

        // Stripe 商品情報 編集
        if(0 < $quantity_item1){
            $array_product[]  =   [
                'amount'        =>      1800,
                'currency'      =>      'jpy',
                'name'          =>      '鰯鯵定食',
                'description'   =>      '【商品説明】鰯鯵定食',
                'quantity'      =>      $quantity_item1,
            ];
        }

        // Stripe 商品情報 編集
        if(0 < $quantity_item2){
            $array_product[]  =   [
                'amount'        =>  2500,
                'currency'      =>  'jpy',
                'name'          => '海の幸定食',
                'description'   => '【商品説明】海の幸定食',
                'quantity'      => $quantity_item2,
            ];
        }


        if(0 < $quantity_item3){
            $array_product[]  =   [
                    'amount'        => 2300,
                    'currency'      => 'JPY',
                    'name'          => '鯛めしおにぎりと鯛の潮汁',
                    'description'   => '【商品説明】鯛めしおにぎりと鯛の潮汁',
                    'quantity'      => $quantity_item3,
            ];
        }

        if(0 < $quantity_item4){
            $array_product[]  =   [
                    'amount'        => 1000,
                    'currency'      => 'JPY',
                    'name'          => 'さる海老の素揚げ',
                    'description'   => '【商品説明】さる海老の素揚げ',
                    'quantity'      => $quantity_item4,
            ];
        }

        if(0 < $quantity_item5){
            $array_product[]  =   [
                    'amount'        => 1500,
                    'currency'      => 'JPY',
                    'name'          => 'サバ味噌煮',
                    'description'   => '【商品説明】サバ味噌煮',
                    'quantity'      => $quantity_item5,
            ];
        }

        if(0 < $quantity_item6){
            $array_product[]  =   [
                    'amount'        => 1300,
                    'currency'      => 'JPY',
                    'name'          => '伊勢海老の味噌汁',
                    'description'   => '【商品説明】伊勢海老の味噌汁',
                    'quantity'      => $quantity_item6,
            ];
        }

        if(0 < $quantity_item7){
            $array_product[]  =   [
                    'amount'        => 1100,
                    'currency'      => 'JPY',
                    'name'          => 'カルボナーラ',
                    'description'   => '【商品説明】カルボナーラ',
                    'quantity'      => $quantity_item7,
            ];
        }

        if(0 < $quantity_item8){
            $array_product[]  =   [
                    'amount'        => 900,
                    'currency'      => 'JPY',
                    'name'          => '彩り野菜の酢漬け',
                    'description'   => '【商品説明】彩り野菜の酢漬け',
                    'quantity'      => $quantity_item8,
            ];
        }

        if(0 < $quantity_item9){
            $array_product[]  =   [
                    'amount'        => 600,
                    'currency'      => 'JPY',
                    'name'          => 'カボチャの冷製スープ',
                    'description'   => '【商品説明】カボチャの冷製スープ',
                    'quantity'      => $quantity_item9,
            ];
        }

        if(0 < $quantity_item10){
            $array_product[]  =   [
                    'amount'        => 500,
                    'currency'      => 'JPY',
                    'name'          => 'ラムレーズンのスコーン',
                    'description'   => '【商品説明】ラムレーズンのスコーン',
                    'quantity'      => $quantity_item10,
            ];
        }

        if(0 < $quantity_item11){
            $array_product[]  =   [
                    'amount'        => 4500,
                    'currency'      => 'JPY',
                    'name'          => '自家製アンチョビ',
                    'description'   => '【商品説明】自家製アンチョビ',
                    'quantity'      => $quantity_item11,
            ];
        }

        if(0 < $quantity_item12){
            $array_product[]  =   [
                    'amount'        => 1800,
                    'currency'      => 'JPY',
                    'name'          => 'キムチチゲ',
                    'description'   => '【商品説明】キムチチゲ',
                    'quantity'      => $quantity_item12,
            ];
        }

        if(0 < $quantity_item13){
            $array_product[]  =   [
                    'amount'        => 900,
                    'currency'      => 'JPY',
                    'name'          => '鶏のから揚げ',
                    'description'   => '【商品説明】鶏のから揚げ',
                    'quantity'      => $quantity_item13,
            ];
        }

        if(0 < $quantity_item14){
            $array_product[]  =   [
                    'amount'        => 800,
                    'currency'      => 'JPY',
                    'name'          => '鶏むね肉のチャーシュー風',
                    'description'   => '【商品説明】鶏むね肉のチャーシュー風',
                    'quantity'      => $quantity_item14,
            ];
        }

        if(0 < $quantity_item15){
            $array_product[]  =   [
                    'amount'        => 1100,
                    'currency'      => 'JPY',
                    'name'          => '味噌チャーシュー麺',
                    'description'   => '【商品説明】味噌チャーシュー麺',
                    'quantity'      => $quantity_item15,
            ];
        }




        //dd($array_product);

        // Secret API keyをセット
        \Stripe\Stripe::setApiKey("sk_test_51IrwPCIGn1OXhDRnsn4686SYweNTg3dMw91Ul9qcwoBhEsdMILD0rOP3LG5HO3UJcSzLR0g8qnpz2Jp1HPsRzeVg00yN4axhV2");
        $s  =   \Stripe\Checkout\Session::create([
                        // 環境変数から取得し設定
                        'success_url' => env('EC_Sample_success_url'),
                        'cancel_url' => env('EC_Sample_cancel_url'),

                        //'success_url' => 'https://lara-assist.appli-support.jp/sample/reflect_purchase_info',
                        //'cancel_url' => 'https://lara-assist.appli-support.jp/sample/',
                        'payment_method_types'  =>  ['card'],
                        'line_items'            =>  $array_product,

        ]);

        $id =   $s['id'];

        //dd($id);

        /*
        return redirect('/payment')
                    ->with([
                        'id'        =>      $id,

                    ]);
                        */


        return view('sample.payment')
                    ->with([
                        'id'            =>      $id,
                        'array_product' =>      $array_product,

                    ]);

    }

    /**
     * 購入した際の画面表示前の処理
     */
    public function beforePurchased() {

        // 購入した商品
    }

    // Stripe 決済後処理
    public function afterStripe() {

        \Session::flash('flash_message', '決済が完了しました');

        return view('sample.stripe_sample');

        // 本来であれば、購入された商品に応じて、処理を行う。
        // （例）チケットなら、ユーザテーブルの所有チケット数を変更する等。
        // また、商品一覧ページへリダイレクトするのではなく、購入商品の確認・ありがとうページを表示させたい。

        // 現状では他を優先させるため、このままとする。

    }
}
