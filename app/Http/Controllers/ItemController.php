<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;


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
    //     $user = Auth::user($id);

    //     $user->name = $request->input('name');
    //     $user->detail = $request->input('detail');
    //     $user->email = $request->input('email');
        
    //     // パスワードの変更は必要な場合のみ
    //     if ($request->input('password')) {
    //         $user->password = Hash::make($request->input('password'));
    //     }

    //     $user->save();

    //     return redirect()->route('profile.index')->with('success', 'アカウント情報が更新されました');
    // }

    /**
     * ユーザーアカウント更新処理
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'detail'=> 'nullable|max:500',
        ], [
            //未入力・重複エラーメッセージ表示
            'name.required' => 'ユーザーネームは必須です。',
            'name.max' => '20文字以内で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは最大255文字まで入力可能です。',
            'email.regex' => 'メールアドレスの形式が正しくありません。',
            'detail.max' => '500文字以内で入力してください。',
        ]);
        $validated['user_id'] = Auth::user();

        dd();

        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'アカウント情報が更新されました');
    }


    /**
     * ユーザーアカウント削除処理
     */
    public function destroy(User $user)
    {
        $user = Auth::user();
        $user->delete();

        return redirect()->route('showLogin')->with('success', 'アカウントが削除されました。');
    }


}
