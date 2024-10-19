<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;



class ItemController extends Controller
{
    /**
     * プロフィール画面　ストック
     */
    // public function index()
    // {
    //     $user = Auth::user();
    //     return view('item.index', compact('user'));
    // }

    /**
     * プロフィール画面
     */
    public function index(Request $request)
    {
        $genres = [
            '1' => '公開',
            '2' => '非公開',
        ];
        $user = Auth::user();

        // ログインしたユーザーの投稿だけを取得
        $items = Item::where('user_id', $user->id)
        ->leftJoin('users', 'users.id', '=', 'items.user_id')
        ->select('items.*', 'users.name')
        ->paginate(10);

        // ログインしたユーザーの投稿に対してつけられた「いいね」数を取得
        $likesCount = Like::whereIn('item_id', $user->items()->pluck('id'))->count();

        return view('item.index', compact('user','items', 'genres', 'likesCount'));
    }

    /**
     * プロフィール編集画面
     */
    public function edit()
    {
        $user = Auth::user();
        return view('item.edit', compact('user'));
    }

    /**
     * ユーザーアカウント更新処理
     */
    public function update(Request $request, User $user)
    {
        // dd($request);
        // \Log::channel('daily')->info($user);

        $image = $request->file('image');

        $validated = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(). ',id|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'detail'=> 'nullable|max:500',
            'image' => 'image|max:50',
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
            'image.max' => '画像サイズが大きい為アップロードできません。※50KBまで',
        ]);
        $user = Auth::user();

        // 画像が更新された時に、DBに保存する処理
        if ($request->hasFile('image')) {
            // 新しい画像がアップロードされていれば更新
            $image = base64_encode(file_get_contents($request->image->getRealPath()));
        } else {
            // 画像の更新がなければ、既存のデータを保持する
            $image = $user->image;
        }
        
        // 個別に値を設定する
        $user->name = $request->name;
        $user->email = $request->email;
        $user->detail = $request->detail;
        $user->image = $image;

        // パスワードの更新がある場合のみ更新
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // ユーザー情報の保存
        $user->save();


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
