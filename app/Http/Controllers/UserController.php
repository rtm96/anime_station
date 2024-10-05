<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * アカウント一覧画面表示
     */
    public function index()
    {
        // ユーザーアカウント一覧＋ページネーション
        $users = User::select('id', 'name', 'email', 'auth', 'created_at', 'updated_at')->paginate(10);

        return view('user.index', compact('users'));
    }

    /**
     * アカウント編集画面表示
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * ユーザーアカウント更新処理
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // チェックボックスが送信されていない場合は一般ユーザーに設定
        $user->auth = $request->has('auth') ? 1 : 0;

        // パスワードの変更は必要な場合のみ
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'アカウント情報が更新されました');
    }

    /**
     * ユーザーアカウント削除処理
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'アカウントが削除されました');
    }


    /**
     * ユーザーアカウント複数削除処理
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('user_ids');
        User::whereIn('id', $ids)->delete();

        return redirect()->route('users.index')->with('success', '選択したアカウントが削除されました');
    }


}
