<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 未ログイン時の出品商品一覧画面(メインページ)のルート
Route::get('/', function () {
    return view('welcome');
});

//新規ユーザーメール登録画面のルート
Route::get('/signup/mail', function (){

});

//新規ユーザー情報登録画面のルート
Route::get('/signup/identification', function () {

});

//新規ユーザー登録情報確認画面のルート
Route::get('/signup/confirmation', function () {
});

//新規ユーザー登録完了画面ルート
Route::get('/signup/complete', function () {
    
});