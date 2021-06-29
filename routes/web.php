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
Route::get('/sample/reflect_purchase_info', 'SampleController@afterStripe');

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
 * サンプル
 */

Route::get('/sample', function () {
    return view('sys.sample');
});

Route::name('sample.')
        ->group(function() {
            Route::get('/',  function () {
                return view('sys.sample')->name('index');
            Route::get('/bc_laravel',  function () {
                return view('sys.bc_laravel')->name('bc_laravel');
            
            });

// ECサンプル
//Route::get('/ec_sample', 'ProductController@index')->name('product.index');
//Route::get('/ec_sample/product/{id}', 'ProductController@show')->name('product.show');

Route::name('product.')
        ->group(function() {
            Route::get('/ec_sample/', 'ProductController@index')->name('index');
            Route::get('/ec_sample/product/{id}', 'ProductController@show')->name('show');
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
