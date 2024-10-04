<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;


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

//TOP画面表示
Route::get('/', [AccountController::class, 'showLogin'])->name('showLogin');
//アカウント画面
Route::get('/register', [AccountController::class, 'register'])->name('register');
//アカウント作成
Route::post('/acctRegister', [AccountController::class, 'acctRegister'])->name('acctRegister');
//アイコン選択
Route::post('/icon',[AccountController::class, 'icon'])->name('icon');
// ログインチェック
Route::post('/login', [AccountController::class, 'login'])->name('login');
// ログアウト機能
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');


// 管理者ユーザーのみ
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    //管理者用ユーザーアカウント一覧画面表示
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    //管理者用ユーザーアカウント編集画面表示
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    //ユーザーアカウント更新処理
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    //ユーザーアカウント削除処理
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    //ユーザーアカウント複数削除処理
    Route::post('/users/multi-delete', [UserController::class, 'multiDelete'])->name('users.multiDelete');


});

//テスト
Route::get('/test', [UserController::class, 'test'])->name('test');

