<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TOP
Route::get('/', function () {
    return view('sys.index');
});

// ご挨拶
Route::get('/about', function () {
    return view('sys.about');
});

// システム
Route::get('/systems', function () {
    return view('sys.systems');
});


/**
 * 予約
 */


// 管理ページ

// 管理トップ

Route::get('/reservation/management', function () {
    return view('reservation.management.index');
});



//Route::post('/reservation/management', 'ReservationController@showAcceptable');

/*
Route::get('/reservation/management/edit_acceptable', function () {
    return view('reservation.management.edit_acceptable');
});
*/

Route::get('/reservation/management/edit_acceptable', 'ReservationController@showAcceptable');

Route::post('/reservation/management/edit_acceptable', 'ReservationController@storeAcceptable');




Route::get('/reservation/management/regist_holiday', function () {
    return view('reservation.management.holiday');
});



// 技術メモ
Route::get('/memo', function () {
    return view('sys.memo');
});

// 問合せ
Route::get('/inquiry', function () {
    return view('sys.inquiry');
});

// 参考サイト
Route::get('/references', function () {
    return view('sys.references');
});

/**
 * 予約機能
 */
// 週別予約可能数情報 取得
/*
Route::get('/reservation', function () {
    return view('reservation.management.index');
});
*/

// 予約画面（15分単位）
Route::get('/reservation', 'ReservationController@getAcceptable');

// 予約処理（15分単位）
Route::post('/reservation/{year}/{month}/{day}/{hour}/{minute}', 'ReservationController@storeReservationQuarter');

// 15分も1時間も、ＤＢから取得する内容は同じなので、遷移元を参照してから表示ブレードを変更したい。パラメータを付加すれば容易か？

// 予約画面（1時間単位）
Route::get('/reservation_hour', 'ReservationController@getAcceptable');

// 予約処理（1時間単位）
Route::post('/reservation_hour/{year}/{month}/{day}/{hour}', 'ReservationController@storeReservationHour');


// 保有チケット確認
Route::get('/reservation/confirm_tickets/{user_id}', 'ReservationController@getTickets_info');

// 登録情報確認
Route::get('/reservation/confirm_user_info/{user_id}', 'ReservationController@getUser_info');

// 登録情報変更
Route::get('/reservation/modify_user_info/{user_id}', 'ReservationController@getUser_info_modify');

// 登録情報変更
Route::post('/reservation/modify_user_info', 'ReservationController@updateUserInfo');

// 予約一覧確認
Route::get('/reservation/confirm_reservation/{user_id}', 'ReservationController@getReservation_info');

// チケット購入
Route::get('/reservation/purchase_ticket/{user_id}', 'ReservationController@getTicket_info');

/**
 * メール送信
 */
Route::get('/sendmail', 'MailSendController@send');

Route::post('/inquiry', 'MailSendController@send');

/**
 * 国試過去問
 */
Route::get('/kokushi', function () {
    return view('kokushi.index');
});

Route::post('systems', 'KokushiController@before_kokushi');

Route::post('/kokushi', 'KokushiController@before_kokushi');

Route::get('/kokushi/{subject_id}', 'KokushiController@showMenu');

// 国試 過去問スタート
Route::post('/kokushi/{subject_id}', 'KokushiController@startPractice');

Route::get('/kokushi/{subject_id}/practice_by_question/{title_id}/{question_number}', 'KokushiController@practiceByQuestion');


/**
 * 雑記
 */

Route::name('blog.')
        ->group(function() {
            Route::get('/blog/', function () {
                return view('sys.blog');
            })->name('index');
        });

/**
 * サンプル
 */

Route::name('sample.')
        ->group(function() {
            Route::get('/sample/',  function () {
                return view('sys.sample');
            })->name('index');

            Route::get('/sample/bc_laravel',  function () {
                return view('sys.bc_laravel');
            
            })->name('bc_laravel');

            // サンプルページ
            Route::get('/sample/stripe_sample', function() {
                return view('sample.stripe_sample');
            });

            // Stripe 決済前処理
            Route::post('/sample/stripe_sample', 'SampleController@beforeStripe');

            // Stripe 決済後処理
            Route::get('/sample/stripe_sample/reflect_purchase_info', 'SampleController@afterStripe');


            /**
             * テスト用
             */

            // 備品管理システム

            Route::name('equip.')
                        ->group(function() {
                            Route::get('/sample/equip', 'EquipController@showMenu')
                                    ->name('index');
                            
                            // 部門マスタ登録画面 表示
                            Route::get('/sample/equip/register_m_dept', 'EquipController@showDepts')
                                    ->name('register_m_dept');
                            
                            // 部門マスタ登録画面 登録処理
                            Route::post('/sample/equip/register_m_dept', 'EquipController@registerDept');

                            // 備品マスタ登録画面 表示
                            Route::get('/sample/equip/register_m_equip', 'EquipController@showEquip')
                                    ->name('register_m_equip');
                            
                            // 備品マスタ登録画面 登録処理
                            Route::post('/sample/equip/register_m_equip', 'EquipController@registerM_equip');



                            // 備品マスタ参照？
                            Route::get('/sample/equip/refer_equip', function (){
                                return view('sample.equip.refer_equip');
                            })->name('refer_equip');
                            
                            // 入出庫管理画面 表示
                            Route::get('/sample/equip/inout_management', function (){
                                return view('sample.equip.inout_management');
                            })->name('inout_management');

                            // 新規アカウント登録画面 表示
                            Route::get('/sample/equip/register_account', 'EquipController@showUser')
                                    ->name('register_account');
                            
                            Route::post('sample/equip/register_account', 'EquipController@registerUser');

                            // 権限編集画面 表示
                            Route::get('/sample/equip/edit_account', function (){
                                return view('sample.equip.edit_account');
                            })->name('edit_account');




                            // 権限登録画面 表示
                            Route::get('/sample/equip/register_privileges', function (){
                                return view('sample.equip.register_privileges');
                            })->name('register_privileges');
                            
                            // 権限編集画面 表示
                            Route::get('/sample/equip/edit_privileges', function (){
                                return view('sample.equip.edit_privileges');
                            })->name('edit_privileges');
                        });


        });

// ECサンプル
//Route::get('/ec_sample', 'ProductController@index')->name('product.index');
//Route::get('/ec_sample/product/{id}', 'ProductController@show')->name('product.show');

Route::name('product.')
        ->group(function() {
            Route::get('/sample/ec_sample/', 'ProductController@index')->name('index');
            Route::get('/sample/ec_sample/product/{id}', 'ProductController@show')->name('show');
        });

Route::name('line_item.')
        ->group(function () {
            Route::post('/ec_sample/line_item/create', 'LineItemController@create')
                                ->name('create');
            Route::post('/ec_sample/line_item/delete', 'LineItemController@delete')
                                ->name('delete');
        });

Route::name('cart.')
        ->group(function () {
            Route::get('/ec_sample/cart', 'CartController@index')->name('index');
            Route::get('/ec_sample/cart/checkout', 'CartController@checkout')
                        ->name('checkout');
            Route::get('/cart/success', 'CartController@success')
                        ->name('success');
        });

/**
 * １週間で基礎から学ぶLaravel入門
 */

Route::resource("book_oneweeks", "Book_oneweekController");

/**
 * 認証機能
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/home_sample', 'HomeController@index')->name('home_sample');

/*
認証機能を２系統作成したかったが、不明のため断念
Auth_sample::routes();
Route::get('home_sample', 'HomeSampleController@index')->name('home_sample');

Route::get('/sample/login', 'LoginSampleController@showLoginForm');
Route::post('/sample/login', 'LoginSampleController@login');
Route::get('/sample/logout', 'LoginSampleController@logout');

Route::get('/sample/password/confirm', 'ConfirmSamplePasswordController@showLoginForm');

Route::post('/sample/password/confirm', 'ConfirmSamplePasswordController@showConfirmForm');

Route::post('/sample/password/email', 'ForgotSamplePasswordController@confirm');

Route::get('/sample/password/reset', 'ForgotSamplePasswordController@showLinkRequestForm');

Route::post('/sample/password/reset', 'ResetSamplePasswordController@reset');

Route::get('/sample/register', 'ResisterSampleController@showRegistrationForm');

Route::post('/sample/register', 'ResisterSampleController@register');
*/

/**
 * テスト環境
 */

