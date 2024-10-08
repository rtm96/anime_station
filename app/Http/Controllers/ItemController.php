<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ItemController extends Controller
{
    /**
     * プロフィール画面
     */
    public function index()
    {
        return view('item.index');
    }
    /**
     * プロフィール編集画面
     */
    public function edit()
    {
        $user = Auth::user();
        return view('item.edit', compact('user'));
    }
    // /**
    //  * ユーザーアカウント更新処理
    //  */
    // public function update(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);

    //     $user->name = $request->input('name');
    //     // $item->detail = $request->input('detail');
    //     $user->email = $request->input('email');
        
    //     // チェックボックスが送信されていない場合は一般ユーザーに設定
    //     $user->auth = $request->has('auth') ? 1 : 0;

    //     // パスワードの変更は必要な場合のみ
    //     if ($request->input('password')) {
    //         $user->password = Hash::make($request->input('password'));
    //     }

    //     $user->save();

    //     return redirect()->route('users.index')->with('success', 'アカウント情報が更新されました');
    // }

    /**
     * ユーザーアカウント削除処理
     */
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect()->route('users.index')->with('success', 'アカウントが削除されました。');
    }


}
