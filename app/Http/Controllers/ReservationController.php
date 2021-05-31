<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reservations;
use App\User_reservations;
use App\Users;

use DB;

use Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /*
    * 週別予約数情報 取得
    */
    public function getAcceptable(Request $request){

        Carbon::setWeekStartsAt(Carbon::SUNDAY);                    // 週の最初を日曜日に設定
        Carbon::setWeekEndsAt(Carbon::SATURDAY);                    // 週の最後を土曜日に設定

        //dd($request->selected_month);

        // 指定年月 存在判定
        if(null !== $request->selected_month){

            //リクエストから年月を取得
            $target_date    =   Carbon::today();
        } else {
            /**
             * 指定年月が存在しない場合
             */
            $target_date    =  Carbon::today();

            // 営業時間 終了後判定
            if(21 < (integer)today()->format('H')){
                $target_date    =  Carbon::today()->addDays(1);
            }

        }

        dd($target_date);

        // 文字列として保存
        $str_target_date    =   (string)$target_date->format('Y-m-d');

        // 該当日 日付取得
        $work_year                 =   $target_date->format('Y');
        $work_month                =   (integer)$target_date->format('m');

        // 週初日
        $firstDayOfWeek            =   $target_date->startOfWeek();                     // 週初日 取得
        // dd($firstDayOfWeek);

        $day_firstDayOfWeek        =   (integer)$target_date->startOfWeek()->format('d');        // 日（週初日） 取得
        $year_firstDayOfWeek       =   $target_date->startOfWeek()->format('Y');        // 年（週初日）  取得
        $month_firstDayOfWeek      =   (integer)$target_date->startOfWeek()->format('m');        // 月（週初日）  取得

        //dd($month_firstDayOfWeek);

        // 週末日
        $lastDayOfWeek             =   $target_date->endOfWeek();                       // 週末日 取得
        $day_lastDayOfWeek         =   (integer)$target_date->endOfWeek()->format('d');          // 日（週末日） 取得
        $year_lastDayOfWeek        =   $target_date->endOfWeek()->format('Y');          // 年（週末日） 取得
        $month_lastDayOfWeek       =   (integer)$target_date->endOfWeek()->format('m');          // 月（週末日） 取得

        // 該当週の初日～週末日を配列へ格納
        $array_this_week_days   =   array();

        $work_day   =   $target_date->startOfWeek();
        //dd($work_day, $firstDayOfWeek);

        for($index_week = 0; $index_week < 7; $index_week++){

            $array_this_week_days[] =   (integer)$work_day->format('d');
            $work_day   =   $work_day->addDay();
        }

        $array_hours    =   [10, 11, 0, 13, 14, 15, 16, 17, 18, 0, 20, 21];

        $array_minutes  =   ['00', '20', '40'];

        // 日時情報 取得
        $year           =   $target_date->format('Y');

        //dd($target_date);
        $month          =   (integer)$target_date->format('m');
        //$month          =   (integer)$month_firstDayOfWeek->format('m');
        $day_today      =   (integer)Carbon::today()->format('d');

        // 経過日数 算出
        $numOfDaysElapsed   =   $day_today  -   $array_this_week_days[0];

        // 月の第何週かを算出
        $numOfWeek = ReservationController::getWeekNum($str_target_date);

        //dd($year, $month);


        // 取得するデータは該当する日付だけで良い（該当月のデータを全件取得している）
        // 追加で、該当週に属する、前月もしくは翌月のデータを取得したい
        // SQL で期間指定をきっちりやれば、目的のデータだけを取得できるのでは？

        // 受付数テーブル読込

        // 年またぎ判定
        if ($year_firstDayOfWeek < $year_lastDayOfWeek){

            //--------------------
            // 年をまたいでいる場合
            //--------------------
            $reservations   =   Reservations::where(function($query)
                use($year_firstDayOfWeek,
                    $month_firstDayOfWeek,
                    $day_firstDayOfWeek) {
                        $query->where('year',       '=',    $year_firstDayOfWeek)
                                ->where('month',    '=',    $month_firstDayOfWeek)
                                ->where('day',      '>=',   $day_firstDayOfWeek);
                        })->where(function($query)
                        use($year_lastDayOfWeek,
                            $month_lastDayOfWeek,
                            $day_lastDayOfWeek) {
                            $query->orwhere('year',     '=',    $year_lastDayOfWeek)
                                    ->where('month',    '=',    $month_lastDayOfWeek)
                                    ->where('day',      '<=',   $day_lastDayOfWeek);
                        })
                        ->orderby('timezone', 'asc')
                        ->orderby('minute', 'asc')
                        ->orderby('year', 'asc')
                        ->orderby('month', 'asc')
                        ->orderby('day', 'asc')
                        ->get();


        // 月またぎ判定
        } else if($day_firstDayOfWeek > $day_lastDayOfWeek){

            //--------------------
            // 月をまたいでいる場合
            //--------------------

            //dd($day_firstDayOfWeek, );
            $reservations   =   Reservations::where(function($query)
                                    use($year_firstDayOfWeek,
                                        $month_firstDayOfWeek,
                                        $day_firstDayOfWeek) {
                                            $query->where('year',       '=',    $year_firstDayOfWeek)
                                                    ->where('month',    '=',    $month_firstDayOfWeek)
                                                    ->where('day',      '>=',   $day_firstDayOfWeek);
                                    })->orwhere(function($query)
                                    use($year_lastDayOfWeek,
                                        $month_lastDayOfWeek,
                                        $day_lastDayOfWeek) {
                                            $query->orwhere('year',     '=',    $year_lastDayOfWeek)
                                                    ->where('month',    '=',    $month_lastDayOfWeek)
                                                    ->where('day',      '<=',   $day_lastDayOfWeek);
                                    })
                                    ->orderby('timezone', 'asc')
                                    ->orderby('minute', 'asc')
                                    ->orderby('year', 'asc')
                                    ->orderby('month', 'asc')
                                    ->orderby('day', 'asc')
                                    ->get();

        } else {
            //--------------------
            // 月をまたいでいない場合
            //--------------------
            $reservations   =   Reservations::where('year', '=', $year)
                                ->where('month', '=', $month)
                                ->where('day', '>=', $day_firstDayOfWeek)
                                ->where('day', '<=', $day_lastDayOfWeek)
                                ->orderby('timezone', 'asc')
                                ->orderby('minute', 'asc')
                                ->orderby('day', 'asc')
                                ->get();
        }

        // ユーザ予約情報テーブル 取得
        $user_reservations  =   User_reservations::where('user_id', '=', Auth::user()->id)
                            ->where('year', '=', $year)                         // 年
                            ->where('month', '=', $month)                       // 月
                            ->where('day', '>=', $day_firstDayOfWeek)           // 日付
                            ->where('day', '<=', $day_lastDayOfWeek)            //
                            ->where('status', '=', 0)                           // 状態コード（予約済）
                            ->orderby('timezone', 'asc')
                            ->orderby('minute', 'asc')
                            ->orderby('day', 'asc')
                            ->get();

        //dd($reservations);

        // 今月のデータしか取得出来ていない。前月もしくは翌月のデータが必要となるケースも存在する。

        //dd($work_month, $work_day, $numOfDaysElapsed);

        // 現在日時 取得
        $now_year           =       (integer)Carbon::now()->format('Y');
        $now_month          =       (integer)Carbon::now()->format('m');
        $now_day            =       (integer)Carbon::now()->format('d');
        $now_hour           =       Carbon::now()->format('H');
        $now_minute         =       Carbon::now()->format('i');

        // チケット情報 取得
        $ticket             =       auth()->user();

        /*
        dd($array_this_week_days,
        $array_hours,
        $array_minutes,
        $reservations,

        $work_year,
        $work_month,
        $work_day,

        $now_year,
        $now_month,
        $now_day,
        $now_hour,
        $now_minute,
        $numOfDaysElapsed,
        $user_reservations,
        $ticket
);

        */

        return view('reservation.weekly')
                        ->with([
                            'days'              =>  $array_this_week_days,      // 該当週の日付配列
                            'hours'             =>  $array_hours,               // 配列 時間帯
                            'minutes'           =>  $array_minutes,             // 配列 分
                            'reservations'      =>  $reservations,              // 予約

                            'year'              =>  $work_year,                 // 該当日 年
                            'month'             =>  $work_month,                // 該当日 月
                            'today'             =>  $work_day,                  // 該当日 日(カーボン使用で日付が変動している)
                            'numOfWeek'         =>  $numOfWeek,                 // 該当日 月内の第何週か

                            'now_year'          =>  $now_year,                  // 現在年
                            'now_month'         =>  $now_month,                 // 現在月
                            'now_day'           =>  $now_day,                   // 現在日付
                            'now_hour'          =>  $now_hour,                  // 現在時間
                            'now_minute'        =>  $now_minute,                // 現在分

                            'numOfDaysElapsed'  =>  $numOfDaysElapsed,          // 経過日数
                            'user_reservations' =>  $user_reservations,         // ユーザー予約情報

                            'ticket'            =>  $ticket,                    // チケット情報
                        ]);

    }

    /*
    * 予約登録処理
    */
    public function storeReservationQuarter($r_year, $r_month, $r_day, $r_hour, $r_minute){

        // 予約画面へ渡すパラメータ 取得

        Carbon::setWeekStartsAt(Carbon::SUNDAY);                    // 週の最初を日曜日に設定
        Carbon::setWeekEndsAt(Carbon::SATURDAY);                    // 週の最後を土曜日に設定

        $target_date    =  Carbon::today();

        // 当日日付取得
        $work_year                 =   $target_date->format('Y');
        $work_month                =   (integer)$target_date->format('m');

        // 週初日
        $firstDayOfWeek            =   $target_date->startOfWeek();                     // 週初日 取得
        //dd($firstDayOfWeek);

        $day_firstDayOfWeek        =   $target_date->startOfWeek()->format('d');        // 日（週初日） 取得
        $year_firstDayOfWeek       =   $target_date->startOfWeek()->format('Y');        // 年（週初日）  取得
        $month_firstDayOfWeek      =   $target_date->startOfWeek()->format('m');        // 月（週初日）  取得

        // 週末日
        $lastDayOfWeek             =   $target_date->endOfWeek();                       // 週末日 取得
        $day_lastDayOfWeek         =   $target_date->endOfWeek()->format('d');          // 日（週末日） 取得
        $year_lastDayOfWeek        =   $target_date->endOfWeek()->format('Y');          // 年（週末日） 取得
        $month_lastDayOfWeek       =   $target_date->endOfWeek()->format('m');          // 月（週末日） 取得

        // 該当週の初日～週末日を配列へ格納
        $array_this_week_days   =   array();

        $work_day   =   $target_date->startOfWeek();
        //dd($work_day, $firstDayOfWeek);

        for($index_week = 0; $index_week < 7; $index_week++){

            $array_this_week_days[] =   (integer)$work_day->format('d');
            $work_day   =   $work_day->addDay();
        }

        $array_hours    =   [10, 11, 0, 13, 14, 15, 16, 17, 18, 0, 20, 21];

        $array_minutes  =   ['00', '20', '40'];

        // 日時情報 取得
        $year           =   $target_date->format('Y');
        $month          =   (integer)$target_date->format('m');
        $day_today      =   (integer)Carbon::today()->format('d');

        // 経過日数 算出
        $numOfDaysElapsed   =   $day_today  -   $array_this_week_days[0];

        // 取得するデータは該当する日付だけで良い（該当月のデータを全件取得している）
        // 追加で、該当週に属する、前月もしくは翌月のデータを取得したい
        // SQL で期間指定をきっちりやれば、目的のデータだけを取得できるのでは？

        // 受付数テーブル読込

        // 月またぎ判定
        if($day_firstDayOfWeek > $day_lastDayOfWeek){

            //--------------------
            // 月をまたいでいる場合
            //--------------------
        } else {
            //--------------------
            // 月をまたいでいない場合
            //--------------------
            $reservations   =   Reservations::where('year', '=', $year)
                                ->where('month', '=', $month)
                                ->where('day', '>=', $day_firstDayOfWeek)
                                ->where('day', '<=', $day_lastDayOfWeek)
                                ->orderby('timezone', 'asc')
                                ->orderby('minute', 'asc')
                                ->orderby('day', 'asc')
                                ->get();
        }

        // ユーザ予約情報テーブル 取得
        $user_reservations  =   User_reservations::where('user_id', '=', Auth::user()->id)
                                            ->where('year', '=', $year)                         // 年
                                            ->where('month', '=', $month)                       // 月
                                            ->where('day', '>=', $day_firstDayOfWeek)           // 日付
                                            ->where('day', '<=', $day_lastDayOfWeek)            //
                                            ->where('status', '=', 0)                           // 状態コード（予約済）
                                            ->orderby('timezone', 'asc')
                                            ->orderby('minute', 'asc')
                                            ->orderby('day', 'asc')
                                            ->get();

        // 重複データ検索
        $check_duplicate    =   User_reservations::where('year', '=', $r_year)
                                                ->where('month', '=', $r_month)
                                                ->where('day', '=', $r_day)
                                                ->where('timezone', '=', $r_hour)
                                                ->where('minute', '=', $r_minute)
                                                ->where('status', '=', 0)
                                                ->count();

        // 重複件数 判定
        if($check_duplicate > 0){

            // 同一人物による予約 判定


/*
            // 重複データ（予約済）有。カレンダー（１５分）へリダイレクト
            return view('reservation.weekly')
                            ->with([
                                'days'              =>  $array_this_week_days,      // 該当週の日付配列
                                'hours'             =>  $array_hours,               // 配列 時間帯
                                'minutes'           =>  $array_minutes,             // 配列 分
                                'reservations'      =>  $reservations,              // 予約
                                'year'              =>  $year_today,                // 該当日 年
                                'month'             =>  $month_today,               // 該当日 月
                                'today'             =>  $day_today,                 // 該当日 日
                                'numOfDaysElapsed'  =>  $numOfDaysElapsed,          // 経過日数
                                'user_reservations' =>  $user_reservations,         // ユーザー予約情報
            ]);
*/
        } else {

            // 保有チケット残数 取得
            $number_ticket15            =   auth()->user()->value('ticket15min');
            $number_ticket15_trial      =   auth()->user()->value('ticket15min_trial');
            $total_number_ticket15      =   $number_ticket15    +   $number_ticket15_trial;


            // 保有チケット残数 判定
            if($total_number_ticket15   >   0){

                // 予約処理

                // チケット減算
                if($number_ticket15_trial > 0){

                    // お試しチケットを１減算
                    auth()->user()->ticket15min_trial -=   1;
                    auth()->user()->save();

                } else {

                    // 15分チケットを１減算
                    auth()->user()->ticket15min -=   1;
                    auth()->user()->save();

                }

                // ユーザ予約情報テーブル 登録
                $user_reservation = new User_reservations();
                $user_reservation->user_id      =   Auth::user()->id;       // ユーザID
                $user_reservation->year         =   $r_year;                // 年
                $user_reservation->month        =   $r_month;               // 月
                $user_reservation->day          =   $r_day;                 // 日
                $user_reservation->timezone     =   $r_hour;                // 時間
                $user_reservation->minute       =   $r_minute;              // 分
                $user_reservation->status       =   0;                      // 予約状態
                $user_reservation->sight_key    =   'origin';               // サイトキー
                $user_reservation->created_at   =   new Carbon('now');      // 新規登録日
                $user_reservation->updated_at   =   null;                   // 
                $user_reservation->save();

                // 予約情報テーブル 更新
                $reservation        =       Reservations::where('year', '=', $r_year)
                                                ->where('month', '=', $r_month)
                                                ->where('day', '=', $r_day)
                                                ->where('timezone', '=', $r_hour)
                                                ->where('minute', '=', $r_minute)
                                                ->first();

                $reservation->number_accepted  += 1;
                $reservation->save();

                $work_request                   =   new Request();
                $work_request->selected_year    =   $r_year;
                $work_request->selected_month   =   $r_month;
                $work_request->selected_day     =   $r_day;

                //ReservationsController::getAcceptable($work_request);

                // フラッシュメッセージ 設定
                session()->flash('message', '予約できました。');



                return redirect('/')
                            ->with([
                                'days'              =>  $array_this_week_days,      // 該当週の日付配列
                                'hours'             =>  $array_hours,               // 配列 時間帯
                                'minutes'           =>  $array_minutes,             // 配列 分
                                'reservations'      =>  $reservations,              // 予約
                                'year'              =>  $year,                      // 該当日 年
                                'month'             =>  $month,                     // 該当日 月
                                'today'             =>  $day_today,                 // 該当日 日
                                'numOfDaysElapsed'  =>  $numOfDaysElapsed,          // 経過日数
                                'user_reservations' =>  $user_reservations,         // ユーザー予約情報
                ]);

            } else {

                // フラッシュメッセージ 設定
                session()->flash('error_message', '15分チケットが無い為、予約できませんでした。');

                // 予約処理中断
                return redirect('/')
                        ->with([
                            'days'              =>  $array_this_week_days,      // 該当週の日付配列
                            'hours'             =>  $array_hours,               // 配列 時間帯
                            'minutes'           =>  $array_minutes,             // 配列 分
                            'reservations'      =>  $reservations,              // 予約
                            'year'              =>  $year,                      // 該当日 年
                            'month'             =>  $month,                     // 該当日 月
                            'today'             =>  $day_today,                 // 該当日 日
                            'numOfDaysElapsed'  =>  $numOfDaysElapsed,          // 経過日数
                            'user_reservations' =>  $user_reservations,         // ユーザー予約情報

                        ]);



            }

        }

    }

    // 登録情報確認 画面遷移前処理
    public function getUser_info() {

        // ユーザーテーブル 取得
        $user       =       auth()->user();

        return view('reservation.confirm_user_info')
                    ->with([
                        'user'  =>  $user,
                    ]);
    }

    // 登録情報変更 画面遷移前処理
    public function getUser_info_modify() {

        // ユーザーテーブル 取得
        $user       =       auth()->user();

        return view('reservation.modify_user_info')
                    ->with([
                        'user'  =>  $user,
                    ]);
    }
    
    // 登録情報変更 テーブル更新処理
    public function updateUserInfo(Request $request) {

        // ユーザーテーブル 取得
        $user       =       auth()->user();

        // バリデーション

        $user->name             =       $request->name;
        $user->email            =       $request->email;
        $user->age              =       $request->age;
        $user->street_address   =       $request->street_address;
        $user->profession       =       $request->profession;
        $user->save();

        // テーブル更新

        // フラッシュメッセージ 設定
        session()->flash('message', '登録情報を変更しました。');

        return redirect('/confirm_user_info/' . $user->id)
                    ->with([
                        'user'  =>  $user,
                    ]);
    }
    


    // 予約一覧確認 画面遷移前処理
    public function getReservation_info() {

        // 予約情報テーブル 取得
        $reservations       =       User_reservations::where('user_id', '=', auth()->user()->id)
                                                            ->orderby('year', 'asc')
                                                            ->orderby('month', 'asc')
                                                            ->orderby('day', 'asc')
                                                            ->orderby('timezone', 'asc')
                                                            ->orderby('minute', 'asc')
                                                            ->get();

        // 予約が単発ではない場合、予約一覧への表示は、つながった時間で表示させたい。
        // 55~00分は、絶対休憩時間にしたい

        $count_reservation      =   0;          // 件数
        $count_aggregation_hour =   0;          // 集約件数（分）
        $count_aggregation_day  =   0;          // 集約件数（日付）
        $work_reservation       =   array();    // 表示用予約配列 宣言

        foreach($reservations as $reservation){

            // 配列内容を旧項目へ保存
            $reservation_old    =   $reservation;

            // 件数加算
            $count_reservation++;

            // 

            /**
             * 分集約
             */
            // 年月日・時間一致判定
            if(     $reservation->year  == $reservation_old->year
                &&  $reservation->month == $reservation_old->month
                &&  $reservation->day   == $reservation_old->day
                &&  $reservation->hour  == $reservation_old->hour
                ){

                // 年月日・時間が一致。予約時間を集約する。
                $work_ymd       =   $reservation->year . '年' . $reservation->month . '月' . $reservation->day . '日';

                if($reservation->minute == '20'){
                    $work_end_time  =   $reservation->hour . '時' . '35' . '分';
                } else if($reservation->minute == '40'){
                    $work_end_time  =   $reservation->hour . '時' . '55' . '分';
                }

                $count_aggregation_hour++;                   // 集約件数（時間ごと）　加算

            } else {

                // 同日の場合もある
                // 日付相違判定
                if( $reservation->year  == $reservation_old->year
                &&  $reservation->month == $reservation_old->month
                &&  $reservation->day   == $reservation_old->day
                ){

                    // 同日の予約として処理（trタグのrowspanの値を1増やす）

                    // 集約件数（時間ごと）　判定
                    if($count_aggregation_hour == 0){

                        // 年月日 編集
                        $work_ymd       =   $reservation->year . '年' . $reservation->month . '月' . $reesrvation->day . '日';

                        // 開始時分 編集
                        $start_time     =   $reservation->timezone . '時' . $reservation->minute . '分';

                        // 終了時分 編集
                        if($reservation->minute == '00'){
                            $work_end_time  =   $reservatin->hour . '時' . '15' . '分';
                        } else if($reservation->minute == '20') {
                            $work_end_time  =   $reservatin->hour . '時' . '35' . '分';
                        } else if($reservation->minute == '40'){
                            $work_end_time  =   $reservatin->hour . '時' . '55' . '分';
                        }
                    }

                } else {

                    // 別日の予約として処理（改行）
                    // 年月日 編集
                    $work_ymd   =       $reservation_old->year  . '年'
                                    .   $reservation_old->month . '月'
                                    .   $reservation_old->month . '日';

                    if($count_aggregation_hour == 0){

                        $work_start_time = '';

                    } else {

                    }
                }


                // 表示用配列へ保存(１件目は使用しない)
                if($count_reservation != 1){

                    // 前回読込んだ内容を表示用配列へ格納する
                    $work_reservation[] =   [
                        $ymd            =>      $work_ymd,
                        $start_time     =>      $work_start_time,
                        $end_time       =>      '',
                    ];
                }

                // 年月日・時間が一致。予約時間を集約する。
                $work_ymd               =   $reservation->year . '年' . $reservation->month . '月' . $reesrvation->day . '日';      // 次以降の年月日
                $work_start_time        =   $reservation->timezone . '時' . $reservation->minute . '分';                            // 次以降の時分

                $count_aggregation_hour =   0;                  // 集約件数（時間ごと） 初期化

            }


            // データ保存
            $reservation_old    =   $reservation;
        }

        return view('reservation.confirm_reservation')
                    ->with([
                        'reservations'  =>  $reservations,
                    ]);
    }

    // チケット購入 画面遷移前処理
    public function getTicket_info() {

        // チケットに関する情報（すでに保有しているチケット数も表示させるか？）
        return view('reservation.purchase_ticket');

    }

    /*
    * 保有チケット確認 画面遷移前処理
    */
    public function getTickets_info($user_id) {

        // チケット情報 取得
        $ticket    =    auth()->user();

        return view('reservation.confirm_tickets')
                    ->with([
                        'ticket'    =>      $ticket,
                    ]);

    }

/**
 * 管理系
 */

    /*
    * 予約可能数編集 画面遷移前処理
    */
    public function showAcceptable(Request $request){

        // 現在カーボン取得
        $now    =   Carbon::now();

        // 遷移元ページ 判別
        if($request->transition_source_page == 0){

            // 指定フォーマットで出力
            $year       =   $now->format('Y');                      // 年
            $month      =   $now->format('m');                      // 月
            $last_day   =   $now->lastOfMonth()->format('d');       // 月末日

        } else {

            // 
            $year       =   $request->year;                         // 年
            $month      =   $request->month;                        // 月
            $last_day   =   Carbon::create($year, $month, 1)
                                    ->lastOfMonth()->format('d');   // 月末日

        }

        $array_years        =   array();                            // 配列 年
        $work_year          =   Carbon::now()->format('Y');         // 

        // 現在年～＋５年を配列へ設定
        for($index = 0; $index < 5; $index++){
            $array_years[]  =   $work_year;
            $work_year++;
        }

        // 月配列 設定
        $array_months   =
                    [1,2,3,4,5,6,7,8,9,10,11,12];

        // 枠数配列 設定
        $array_number_acceptable    =
                    [0,1,2,3,4];

        // 時間帯配列 設定
        $array_timezone =
                    [10,11,0,13,14,15,16,17,18,0,20,21];

        $array_days         =   array();        // 日付配列 宣言
        $array_dayOfWeek    =   array();        // 曜日配列 宣言

        $week_day           =   ['日', '月', '火', '水', '木', '金', '土'];

        // 日付配列 設定
        for($index_day = 1; $index_day < ((integer)$last_day + 1); $index_day++){
            $array_days[]       =   $index_day;

            $array_dayOfWeek[]  =   $week_day[Carbon::create($year, $month, $index_day)->dayOfWeek];    // 曜日格納

        }

        // テーブル読込
        $array_data = '';

        // 日付・時間帯ごとに設定 $array_data[日付][時間帯]


        // 予約可能数編集 画面遷移
        return view('reservation.management.edit_acceptable')
                    ->with([
                        'p_array_years'       =>      $array_years,               // 配列 表示対象となる年
                        'p_year'              =>      $year,                      // 選択対象の年
                        'p_array_months'      =>      $array_months,              // 配列 表示対象となる月
                        'p_month'             =>      $month,                     // 選択対象の月
                        'p_last_day'          =>      $last_day,                  // 選択対象月の最終日
                        'p_acceptables'       =>      $array_number_acceptable,   // 配列 受付可能数
                        'p_array_days'        =>      $array_days,                // 配列 日付
                        'p_array_timezones'   =>      $array_timezone,            // 配列 時間帯
                        'p_array_dayOfWeek'   =>      $array_dayOfWeek,           // 配列 曜日
                        'p_data'              =>      $array_data,                // 配列 日付・時間帯ごと予約数
                    ]);
    }

    /*
    * 受付人数登録処理
    */
    public function storeAcceptable (Request $request) {

        // 入力項目 取得
        $year           =   $request->r_year;
        $month          =   $request->r_month;
        $last_day_month =   Carbon::create($year, $month, 1)->lastOfMonth()->format('d');

        // データ存在判定
        $count_reservation   =   Reservations::where('year', '=', $year)
                                        ->where('month', '=', $month)
                                        ->where('day', '=', '1')
                                        ->where('timezone', '=', '10')
                                        ->where('minute', '=', '00')
                                        ->count();

        if($count_reservation == 0){
            //**********
            // 登録処理
            //**********
            // 時間帯配列 宣言
            $array_timezone =   [10,11,13,14,15,16,17,18,20,21];

            $array_minute   =   ['00', '20', '40'];

            // リクエストデータ配列 宣言
            $array_insert =   array();

            // ループ（日付）
            for($index_day = 1; $index_day < $last_day_month + 1; $index_day++){
                // ループ（時間帯）
                for($index_hour = 0; $index_hour < 10; $index_hour++){

                    // name編集
                    $work_name  =   'd' . $index_day . 'h' . $array_timezone[$index_hour];

                    // ループ（分）
                    for($index_minute = 0; $index_minute < 3; $index_minute++){

                        if($index_day < 10){
                            $work_day = '0' . (string)$index_day;
                        } else {
                            $work_day = (string)$index_day;
                        }
                        

                        $array_insert[] =   array(
                                "year"              =>  $year,                          // 年
                                "month"             =>  $month,                         // 月
                                "day"               =>  $work_day,                      // 日
                                "timezone"          =>  $array_timezone[$index_hour],   // 時間帯
                                "minute"            =>  $array_minute[$index_minute],   // 分
                                "number_available"  =>  $request->$work_name,           // 受付可能数
                                "number_accepted"   =>  0,                              // 受付済数
                                "sight_key"         =>  'origin',                       // サイトキー
                                "created_at"        =>  Carbon::now(),                  // 新規作成日時
                                "updated_at"        =>  null,                           // 更新日時
                        );
                    }
                }
            }

            /*
            * 
            */
            Reservations::insert($array_insert);


            //dd($array_insert);

        } else {
            //**********
            // 更新処理
            //**********
        }

        $array_years        =   array();                            // 配列 年
        $work_year          =   (integer)Carbon::now()->format('Y');         // 

        // 現在年～＋５年を配列へ設定
        for($index = 0; $index < 5; $index++){
            $array_years[]  =   $work_year;
            $work_year++;
        }

        // 月配列 設定
        $array_months   =
        [1,2,3,4,5,6,7,8,9,10,11,12];

        // 枠数配列 設定
        $array_number_acceptable    =
                    [0,1,2,3,4];

        // 時間帯配列 設定
        $array_timezone =
                    [10,11,0,13,14,15,16,17,18,0,20,21];

        // 後で修正が必要
        $last_day   =   Carbon::today()->endOfWeek()->format('d');

        $array_days         =   array();        // 日付配列 宣言
        $array_dayOfWeek    =   array();        // 曜日配列 宣言

        $week_day           =   ['日', '月', '火', '水', '木', '金', '土'];

        // 日付配列 設定
        for($index_day = 1; $index_day < ((integer)$last_day_month + 1); $index_day++){
            $array_days[]       =   $index_day;

            $array_dayOfWeek[]  =   $week_day[Carbon::create($year, $month, $index_day)->dayOfWeek];    // 曜日格納

        }

        return view('reservation.management.edit_acceptable')
                ->with([
                    'p_array_years'       =>      $array_years,               // 配列 表示対象となる年
                    'p_year'              =>      $year,                      // 選択対象の年
                    'p_array_months'      =>      $array_months,              // 配列 表示対象となる月
                    'p_month'             =>      $month,                     // 選択対象の月
                    'p_last_day'          =>      $last_day_month,            // 選択対象月の最終日
                    'p_acceptables'       =>      $array_number_acceptable,   // 配列 受付可能数
                    'p_array_days'        =>      $array_days,                // 配列 日付
                    'p_array_timezones'   =>      $array_timezone,            // 配列 時間帯
                    'p_array_dayOfWeek'   =>      $array_dayOfWeek,           // 配列 曜日
                    //'p_data'              =>      $array_data,                // 配列 日付・時間帯ごと予約数
                ]);

    }

    public function showInquiry(){
        return view('reservation.inquiry');
    }

    /**
     * 日付からその月の第何週かを算出する
     */
    public function getWeekNum($date) {
        $time = strtotime($date);
        return 1 + date('W', $time + 86400) - date('W', strtotime(date('Y-m', $time)) + 86400);
    }
}
