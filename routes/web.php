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
    return view('sys.index');
});

Route::get('/systems', function () {
    return view('sys.systems');
});

Route::get('/reservation', function () {
    return view('sys.reservation');
});

Route::get('/hmemo', function () {
    return view('sys.memo');
});

Route::get('/inquiry', function () {
    return view('sys.inquiry');
});

Route::get('/references', function () {
    return view('sys.references');
});

