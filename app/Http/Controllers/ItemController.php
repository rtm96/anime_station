<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;


class ItemController extends Controller
{
    /**
     * プロフィール画面
     */
    public function index()
    {
        $user = Auth::user();
        return view('item.index', compact('user'));
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
        // dd($request);
        \Log::channel('daily')->info($user);

        $image = $request->file('image');

        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(). ',id|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'detail'=> 'nullable|max:500',
            'image' => 'image',
        ], [
            //未入力・重複エラーメッセージ表示
            'name.required' => 'ユーザーネームは必須です。',
            'name.max' => '20文字以内で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは最大255文字まで入力可能です。',
            'email.regex' => 'メールアドレスの形式が正しくありません。',
            'detail.max' => '500文字以内で入力してください。',
            'image.image' => '無効なファイル形式です。',
        ]);
        $user = Auth::user();

        // dd($request);
        \Log::channel('daily')->info($user);

        // $path = null;

        // 画像がアップロードされていれば、storageに保存する処理
        if($request->hasFile('image')){
            $path = Storage::put('/public/img', $image);
            $path = explode('/', $path);
            $path = $path[2];
            $user->image = $path;
        }

        // dd($path);

        // ユーザーの登録処理　画像が入っている場所を示す処理を追加
        $user->name = $request->name;
        if($user->email !== $request->input('email')){
            \Log::channel('daily')->info($user->email);
            \Log::channel('daily')->info($request->input('email'));

            $user->email = $request->email;
        }
        $user->detail = $request->detail;
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
        // dd($user);
        // $user->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'detail' => $request->detail,
        //     'password' => bcrypt($request->password), 
        //     'image' => $path,
        // ]);

        $user->save();
        // dd($validated);

        return redirect()->route('profile.index')->with('success', 'アカウント情報が更新されました。');
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
