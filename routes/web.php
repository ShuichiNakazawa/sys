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

// Laravel コマンドリスト
Route::get('/memo/laravel_command_list', function() {
    return view('memo.laravel_command_list');
});

// git コマンドリスト
Route::get('/memo/git_command_list', function() {
    return view('memo.git_command_list');
});

// 主要HTMLタグ
Route::get('/memo/html_tag_main_list', function() {
    return view('memo.html_tag_main_list');
});

// SNS用のメタタグ設定
Route::get('/memo/display_setting_for_sns', function() {
    return view('memo.display_setting_for_sns');
});

/**
 * Vue.js コツツボ
 */

Route::get('/memo/vue_kotutubo', function() {
    return view('memo.vue_kotutubo');
});

// テキスト
Route::get('/text', function () {
    return view('sys.text');
});

Route::get('/text/html_basic', function () {
    return view('text.html_basic');
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

/******************************
 * テキスト
******************************/
//Route::get('/text/p5_js/{lesson}/{chapter}', 'TextController@showText');      テキストをブレード化した時用

Route::get('/text/p5_js/1/1', function(){
    return view('text.p5js.1-1');
});

Route::get('/text/p5_js/1/2', function(){
    return view('text.p5js.1-2');
});

/******************************
 * 国試過去問
 ******************************/
//　ユーザー向けページ
Route::name('kokushi.')->group(function() {
    Route::name('question.')->group(function() {

        Route::get('/kokushi', 'KokushiQuestionController@before_kokushi');

        /*
        Route::get('/kokushi', function () {
            return view('kokushi.index');
        });
        */

        Route::post('systems', 'KokushiQuestionController@before_kokushi');


        
        Route::post('/kokushi', 'KokushiQuestionController@before_kokushi');

        Route::get('/kokushi/{subject_id}', 'KokushiQuestionController@showMenu');

        // 国試 過去問スタート
        //Route::post('/kokushi/{subject_id}', 'KokushiQuestionController@startPractice');

        // 上のルートを廃止して、新規ルートから出題画面を表示させたい
        Route::post('/kokushi/set_question/{subject_id}', 'KokushiQuestionController@setQuestion');


        // 一問一答　表示
        Route::get('/kokushi/{subject_id}/practice_by_question/{title_id}/{question_number}', 'KokushiQuestionController@practiceByQuestion');

        // 音声ページ
        Route::get('/kokushi/audio/{subject_id}', 'KokushiQuestionController@showAudio');
    });

/******************************
 * 国試過去問 管理系
 ******************************/
    Route::name('management.')->group(function() {
        Route::get('/kokushi/management/index', function() {
            return view('kokushi.management');
        });

        //Route::get('/kokushi/management/store_subject', 'KokushiController@storeSubject');


        // 科目グループ　登録画面　表示処理
        Route::get('/kokushi/management/store_subject_group', 'KokushiManagementController@pageStoreSubjectGroups');

        // 科目グループ　登録処理
        Route::post('/kokushi/management/store_subject_group', 'KokushiManagementController@storeSubjectGroup');

        // 科目グループ一覧　表示　表示処理
        Route::get('/kokushi/management/subject_group_list', 'KokushiManagementController@showSubjectGroups');

        // 科目グループ一覧　編集画面　表示処理
        Route::post('/kokushi/management/subject_group_list/{id}', 'KokushiManagementController@editSubjectGroup');

        // 科目グループ一覧　削除処理
        Route::delete('/kokuchi/management/subject_group_list', 'KokushiManagementController@destroySubjectGroup');


        // 科目名登録　画面表示
        Route::get('/kokushi/management/store_subject', 'KokushiManagementController@pageStoreSubject');

        // 科目名登録　登録処理
        Route::post('/kokushi/management/store_subject', 'KokushiManagementController@storeSubject');


        // 科目名一覧表示　表示処理
        Route::get('/kokushi/management/subject_list', 'KokushiManagementController@showSubjects');

        // 科目名一覧　編集処理
        Route::post('/kokushi/management/subject_list', 'KokushiManagementController@editSubject');

        // 科目名一覧　削除処理
        Route::delete('/kokuchi/management/subject_list', 'KokushiManagementController@destroySubject');


        // 問題タイトル　登録画面　表示処理
        Route::get('/kokushi/management/store_title', 'KokushiManagementController@showStoreTitle');

        // 問題タイトル　登録画面　登録処理
        Route::post('/kokushi/management/store_title', 'KokushiManagementController@storeTitle');


        // 問題タイトル一覧　表示処理
        Route::get('/kokushi/management/title_list/{title_id}', 'KokushiManagementController@showTitles');

        // 問題タイトル一覧　削除処理
        Route::delete('/kokushi/management/title_list', 'KokushiManagementController@destroyQuestionsTitle');


        // 問題文一覧　表示処理
        Route::get('/kokushi/management/qsentence_list', 'KokushiManagementController@showQuestionSentences');

        // 問題文一覧　編集画面　表示処理
        Route::get('/kokushi/management/edit_q_sentence/{subject_id}/{title_id}/{question_number}', 'KokushiManagementController@showQuestionSentence');

        // 問題文一覧　編集画面　編集処理
        Route::post('/kokushi/management/edit_q_sentence/{subject_id}/{title_id}/{question_number}', 'KokushiManagementController@editQuestionSentence');

        // 問題文一覧　削除処理
        Route::delete('/kokushi/management/qsentence_list', 'KokushiManagementController@destroyQuestionsSentence')
                        ->name('destroyQuestionSentence');


        // 問題文登録　登録画面表示
        Route::get('/kokushi/management/store_q_sentence', 'KokushiManagementController@showStoreQuestionSentence');

        // 問題文登録　登録処理
        Route::post('/kokushi/management/store_q_sentence', 'KokushiManagementController@StoreQuestionSentence');


    });
});

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

            // Vue.jsのツボとコツがゼッタイわかる本
            Route::get('/sample/bc_vue_tubokotu', function() {
                return view('sample.bc_vue_tubokotu.index');
            });

            // 商品一覧ページ
            Route::get('/sample/bc_vue_tubokotu/product_list', function() {
                return view('sample.bc_vue_tubokotu.product_list');
            });

            // 自動見積フォーム
            Route::get('/sample/bc_vue_tubokotu/quote_form', function() {
                return view('sample.bc_vue_tubokotu.quote_form');
            });

            // サンプルページ
            Route::get('/sample/stripe_sample', function() {
                return view('sample.stripe_sample');
            });

            // Stripe 決済前処理
            Route::post('/sample/stripe_sample', 'SampleController@beforeStripe');

            // Stripe 決済後処理
            Route::get('/sample/stripe_sample/reflect_purchase_info', 'SampleController@afterStripe');


            // p5.js
            Route::get('/sample/p5', 'SampleController@p5_index')
                                ->name('p5_index');

            Route::get('/sample/p5/bar_graph', 'SampleController@showBar_graph')
                                ->name('bar_graph');

            Route::get('/sample/p5/break_block', 'SampleController@showBreak_block')
                                ->name('break_block');

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

                            // 備品マスタ編集画面 表示
                            Route::get('sample/equip/edit_m_equip', 'EquipController@getM_equip')->name('edit_m_equip');

                            // 備品マスタ編集画面 編集処理
                            Route::post('sample/equip/edit_m_equip/{id}', 'EquipController@editM_equip');


                            // 備品参照
                            Route::get('/sample/equip/refer_equip', 'EquipController@referEquipment')->name('refer_equip');
                            
                            // 入出庫管理画面 表示
                            Route::get('/sample/equip/inout_management',  'EquipController@referInout')->name('inout_management');

                            // 新規アカウント登録画面 表示
                            Route::get('/sample/equip/register_account', 'EquipController@showUser')
                                    ->name('register_account');
                            
                            Route::post('sample/equip/register_account', 'EquipController@registerUser');

                            Route::get('sample/equip/refer_user', 'EquipController@referUser')->name('refer_user');

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

            
                        Route::name('bc_css_grid.')
                        ->group(function() {

                            Route::get('/sample/bc_css_grid', function (){
                                return view('sample.bc_css_grid.index');
                            })->name('index');

                            Route::get('/sample/bc_css_grid/magazine_style', function (){
                                return view('sample.bc_css_grid.magazine_style');
                            })->name('magazine_style');
                            

                            Route::get('/sample/bc_css_grid/flyer_style', function (){
                                return view('sample.bc_css_grid.flyer_style');
                            })->name('flyer_style');
                            

                            Route::get('/sample/bc_css_grid/picture_contents', function (){
                                return view('sample.bc_css_grid.picture_contents');
                            })->name('picture_contents');

                            Route::get('/sample/bc_css_grid/picture_contents_asymmetry', function (){
                                return view('sample.bc_css_grid.picture_contents_asymmetry');
                            })->name('picture_contents_asymmetry');
                            
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
Route::get('/app_test', 'IpquestionController@showIndex');

Route::post('/app_test', 'IpquestionController@selectMenu')->name('select_menu');

Route::get('/test/musatrasama', 'MusatrasamaController@showIndex');

Route::get('/test' , function() {
    return view('test.test');
});


/**
 * 練習ページ
 */
Route::get('/practice/3_1', function() {
    return view('practice.3_1');
});

Route::get('/practice/3_3', function() {
    return view('practice.3_3');
});

Route::get('/practice/4_2', function() {
    return view('practice.4_2');
});

/**
 * リニューアル国試
 */
// 科目ごとにメニュー表示
 Route::get('/excercise_menu/{subject}', 'ExcerciseController@showMenu');

// API
Route::get('/excercise_menu/{subject_id}/{questionMode}/{param}', 'ExcerciseController@setQuestionInfo');

// ランダム演習 
Route::get('/excercise_random/{subject}', 'ExcerciseController@startRandomExcercise');

// 年度指定演習
Route::get('/excercise_selected/{subject}', 'ExcerciseController@startSelectedExcercise');

// ログイン画面
Route::get('/excercise_menu/login', 'HomeController@index')->name('home');


 /*
 *  テンプレート
 */ 
Route::get('/template', 'TemplateController@showIndex');

/*
*   CARHYTHM（キャリズム）
*/
Route::get('/carhythm', function(){
    return view('carhythm.index');
});
