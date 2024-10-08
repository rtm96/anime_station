<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class VideoController extends Controller
{
    /**
     * 動画投稿一覧画面表示
     */
    public function index()
    {
    
        return view('video.index');
    }

    /**
     * 動画視聴画面表示
     */
    public function show()
    {
    
        return view('video.show');
    }

    /**
     * 動画投稿画面表示
     */
    public function create()
    {
    
        return view('video.create');
    }

    /**
     * 投稿登録処理
     */
    public function store(Request $request)
    {
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

        return redirect()->route('video.index');
    }

    /**
     * 動画投稿編集画面表示
     */
    public function edit()
    {
    
        return view('video.edit');
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

        $item->update($validated);

        return redirect()->route('video.index');
    }


    /**
     * 投稿削除処理
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('index');
    }
}
