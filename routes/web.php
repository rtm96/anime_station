<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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

Route::get('/', function () {
    return view('welcome');
});

//TOP画面
Route::get('/', [AccountController::class, 'showLogin'])->name('showLogin');
//アカウント作成
Route::post('/acctRegister', [AccountController::class, 'acctRegister'])->name('acctRegister');
//アイコン選択
Route::post('/icon',[AccountController::class, 'icon'])->name('icon');
// ログインチェック
Route::post('/login', [AccountController::class, 'login'])->name('login');
// ログアウト機能
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');


