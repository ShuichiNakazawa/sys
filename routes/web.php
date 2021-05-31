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
 * Stripe
 **/
// サンプルページ
Route::get('/stripe_sample', function() {
    return view('sample.stripe_sample');
});

// Stripe 決済前処理
Route::post('/stripe_sample', 'SampleController@beforeStripe');

// Stripe 決済後処理
Route::get('sample/reflect_purchase_info', 'SampleController@afterStripe');

/**
 * 予約
 */
// TOP
Route::get('/reservation', function () {
    return view('sys.reservation');
});

// 管理ページ

// 管理トップ
Route::get('/reservation/management', 'ReservationController@showAcceptable');

/*
Route::get('/reservation/management', function () {
    return view('reservation.management.index');
});
*/

Route::get('/reservation/management/regist_holiday', function () {
    return view('reservation.management.holiday');
});

Route::get('/reservation/management/edit_acceptable', function () {
    return view('reservation.management.edit_acceptable');
});

Route::post('/reservation/management/edit_acceptable', 'ReservationController@storeAcceptable');





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
Route::get('/reservation', function () {
    return view('reservation.management.index');
});

//Route::get('/reservation', 'ReservationController@getAcceptable');

// 予約
Route::post('/reservation/{year}/{month}/{day}/{hour}/{minute}', 'ReservationController@storeReservationQuarter');



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
 * 認証機能
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
