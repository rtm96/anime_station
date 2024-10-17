<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * いいね追加
     */
    public function store($itemId)
    {
        $item = Item::findOrFail($itemId);

        // 既にいいねされていないか確認
        $like = Like::where('user_id', Auth::id())
                    ->where('item_id', $item->id)
                    ->first();

        if (!$like) {
            Like::create([
                'user_id' => Auth::id(),
                'item_id' => $itemId,
            ]);

            // 最新のいいね数を取得
            $likesCount = $item->likesCount();

            return response()->json([
                'success' => true,
                'likes_count' => $likesCount,
                'liked' => true,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Already liked',
        ], 400);
    }

    /**
     * いいね取り消し
     */
    public function destroy($itemId)
    {
        $item = Item::findOrFail($itemId);

        // ログインしているユーザーのいいねを取得
        $like = Like::where('user_id', Auth::id())
                    ->where('item_id', $item->id)
                    ->first();

        if ($like) {
            $like->delete();

            // 最新のいいね数を取得
            $likesCount = $item->likesCount();

            return response()->json([
                'success' => true,
                'likes_count' => $likesCount,
                'liked' => false,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Like not found',
        ], 404);
    }
}


