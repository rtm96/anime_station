<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Bbs;


class AccountController extends Controller
{
    /**
     * TOP画面
     */
    public function showLogin()
    {
        
        return view('account.login');//まだ変更していない
    }

    /**
     * アカウント作成画面
     */
    public function register(Request $request){
        
        return view('account.register');
    }

    /**
     * アカウント作成
     * 
     * @param Request $request
     * @return Response
     */
    public function acctRegister(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:20|unique:users',
            'email' => 'required|email|unique:users,email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|min:8|max:16|confirmed|regex:/^[a-zA-Z0-9]+$/',
            'image' => 'image|max:50',
        ],[
            //未入力・重複・超過エラーメッセージ表示
            'name.required' => 'ユーザーネームは必須です。',
            'name.unique' => 'このユーザーネームは既に登録されています。',
            'name.max' => '20文字以内で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'email.max' => 'メールアドレスは最大255文字まで入力可能です。',
            'email.regex' => 'メールアドレスの形式が正しくありません。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => '8文字以上である必要があります。',
            'password.max' => '16文字以内で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
            'password.regex' => 'パスワードは半角英数字のみで入力してください。',
            'image.image' => '無効なファイル形式です。',
            'image.max' => '画像サイズが大きい為アップロードできません。※50KBまで',
        ]);

        // $image = $request->file('image');


        // 画像がアップロードされていれば、DBに保存する処理
        if($request->hasFile('image')){
            // 受け取った画像データをbase64でエンコードしてDBに格納
            $image = base64_encode(file_get_contents($request->image->getRealPath()));
        }else{
            $image = null;
        }

        // ユーザーの登録処理　画像が入っている場所を示す処理を追加
        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), //パスワードをハッシュ化
            'image' => $image,
        ]);
        
        // ログイン画面にリダイレクト
        return redirect()->route('showLogin')->with('success', 'アカウントが作成されました。');

    }

    /**
     * ログインチェック
     * 
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:16|regex:/^[a-zA-Z0-9]+$/',
        ],[
            //未入力・重複・超過エラーメッセージ表示
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは最大255文字まで入力可能です。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => '8文字以上である必要があります。',
            'password.max' => '16文字以内で入力してください。',
            'password.regex' => 'パスワードは半角英数字のみで入力してください。',
        ]);

        // 入力された email と password を取得
        $credentials = $request->only('email', 'password');

        // 入力された email がデータベースに存在するか確認
        $user = User::where('email', $request->email)->first();

        if ($user) {
        // email が存在する場合、パスワードをチェックして認証を試行
        if (Auth::attempt($credentials)) {
            // 認証成功した場合、ユーザーをプロフィール画面にリダイレクト
            return redirect('/profile');
        } else {
            // パスワードが間違っている場合、email を保持してエラーメッセージを返す
            return redirect()->back()//backが必要か確認する
                ->withInput($request->only('email')) // email を保持
                ->withErrors([
                    'loginError' => 'パスワードが間違っています。',
                ]);
            }
        }else {
            // email が存在しない場合、email の値をクリアしてエラーメッセージを返す
            return redirect()->back()
                ->withErrors([
                    'loginError' => 'メールアドレスまたはパスワードが間違っています。',
                ]);
        }
    }

    /**
     * ログアウト
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'ログアウトしました。');
    }
}
