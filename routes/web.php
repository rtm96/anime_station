<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\LikeController;


// Route::get('/', function () {
//     return view('welcome');
// });

//TOP画面表示
Route::get('/', [AccountController::class, 'showLogin'])->name('showLogin');
//アカウント画面表示
Route::get('/register', [AccountController::class, 'register'])->name('register');
//アカウント作成
Route::post('/acctRegister', [AccountController::class, 'acctRegister'])->name('acctRegister');
//アイコン選択
Route::post('/icon',[AccountController::class, 'icon'])->name('icon');
// ログイン機能
Route::post('/login', [AccountController::class, 'login'])->name('login');
// ログアウト機能
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');


//プロフィール画面表示
Route::get('/profile',[ItemController::class, 'index'])->name('profile.index');
//プロフィール編集画面表示
Route::get('/profile/edit',[ItemController::class, 'edit'])->name('profile.edit');
//プロフィール更新処理
Route::put('/profile/{id}',[ItemController::class, 'update'])->name('profile.update');
//プロフィール削除処理
Route::delete('/profile/{id}',[ItemController::class, 'destroy'])->name('profile.destroy');


Route::group(['middleware' => 'auth'], function () {
    //動画投稿一覧画面表示
    Route::get('/video', [VideoController::class, 'index'])->name('video.index');
    //ログインユーザー投稿一覧表示
    // Route::get('/user-posts', [VideoController::class, 'profile'])->name('userPost');
    //動画視聴画面表示
    Route::get('/video/show/{item}', [VideoController::class, 'show'])->name('video.show');
    //動画投稿画面表示
    Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');
    //動画投稿登録処理
    Route::post('/video/create', [VideoController::class,'store'])->name('video.store');
    //動画投稿編集画面表示
    Route::get('/video/{item_id}/edit', [VideoController::class, 'edit'])->name('video.edit');
    //動画投稿更新処理
    Route::put('/video/{item}', [VideoController::class, 'update'])->name('video.update');
    //動画投稿削除処理
    Route::delete('/video/{item}', [VideoController::class, 'destroy'])->name('video.destroy');
});


//いいね機能非同期実装
Route::group(['middleware' => ['auth:sanctum']], function () {
    // いいね付与
    Route::post('/like/{itemId}', [LikeController::class, 'liked'])->name('liked');
    // いいね取り消し
    // Route::delete('/unlike/{itemId}', [LikeController::class, 'destroy'])->name('unlike');
});


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
    Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');


});

