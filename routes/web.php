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

Route::get('/', function () {
    return view('sys.index');
});

Route::get('/about', function () {
    return view('sys.about');
});

Route::get('/systems', function () {
    return view('sys.systems');
});

Route::get('/reservation', function () {
    return view('sys.reservation');
});

Route::get('/memo', function () {
    return view('sys.memo');
});

Route::get('/inquiry', function () {
    return view('sys.inquiry');
});
    
Route::get('/references', function () {
    return view('sys.references');
});

/**
 * 予約昨日
 */
// 週別予約可能数情報 取得
Route::get('/reservation', 'ReservationController@getAcceptable');

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
