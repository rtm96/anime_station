<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class VideoController extends Controller
{
    /**
     * 動画投稿一覧画面表示
     */
    public function index(Request $request)
    {
        $genres = [
            '1' => '公開',
            '2' => '非公開',
        ];
        $user = Auth::user();//追加
        $query = Item::leftJoin('users', 'users.id', '=', 'items.user_id')
        ->select('items.*','users.name');

        // 検索機能追加
        $keyword = $request->input('keyword');

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('users.name', 'LIKE', "%{$keyword}%");
        }

        $items = $query->paginate(10);

        return view('video.index', compact('user','items', 'genres','keyword'));
    }

    /**
     * 動画視聴画面表示
     */
    public function show(Item $item)
    {

        // $user = Auth::user();
        // $item = Item::find($item_id);
        $user = $item->user; // 各動画がユーザーに紐づいていることを想定

        // \Log::channel('daily')->info($item);
        // return view('video.show',  compact('user','item'));
        return view('video.show', compact('item', 'user'));
    }

    /**
     * 動画投稿画面表示
     */
    public function create()
    {

        $user = Auth::user();
        return view('video.create', compact('user'));
    }

    /**
     * 投稿登録処理
     */
    public function store(Request $request)
    {
        // dd($request);

        $validated = $request->validate([
            'title'=>'required|string|max:100',
            'type'=>'required|numeric|max:10',
            'detail'=>'required|string|max:500',
            'videoURL'=>'required|url|string|max:500',
        ], [
            //未入力・重複・超過エラーメッセージ表示
            'title.required' => 'タイトルが入力されていません。',
            'title.max' => '100文字以内で入力してください。',
            'type.required' => 'ジャンルが選択されていません。',
            'detail.required' => '詳細が入力されていません。',
            'detail.max' => '500文字以内で入力してください。',
            'videoURL.required' => 'URLが入力されていません。',
            'videoURL.url' => '有効なURLではありません。',
            'videoURL.max' => '500文字以内で入力してください。',
        ]);
        $validated['user_id'] = Auth::id();
        Item::create($validated);

        return redirect()->route('video.index')->with('success', '動画を投稿しました。');
    }

    /**
     * 動画投稿編集画面表示
     */
    public function edit($item_id){

        $user = Auth::user();
        $item = Item::find($item_id);
        
        //ログインユーザーのみアクセス可能
        if (! Gate::allows('admin-or-myItem', $item)) {
            abort(403);
        }
        return view('video.edit', compact('user','item'));
    }

    /**
     * 投稿更新処理
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'title'=>'required|string|max:100',
            'type'=>'required|numeric|max:10',
            'detail'=>'required|string|max:500',
            'videoURL'=>'required|url|string|max:500',
        ], [
            //未入力・重複エラーメッセージ表示
            'title.required' => 'タイトルが入力されていません。',
            'title.max' => '100文字以内で入力してください。',
            'type.required' => 'ジャンルが選択されていません。',
            'detail.required' => '詳細が入力されていません。',
            'detail.max' => '500文字以内で入力してください。',
            'videoURL.required' => 'URLが入力されていません。',
            'videoURL.url' => '有効なURLではありません。',
            'videoURL.max' => '500文字以内で入力してください。',
        ]);
        $validated['user_id'] = Auth::id();

        // dd($request);

        $item->update($validated);

        return redirect()->route('video.index')->with('success', '投稿が更新されました。');
    }


    /**
     * 投稿削除処理
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('video.index')->with('success', '投稿が削除されました。');
    }
}
