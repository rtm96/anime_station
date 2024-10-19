<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * いいね機能
     */
    public function liked($itemId)
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


        }else{
            $like->delete();

        }
            // 最新のいいね数を取得
            $likesCount = $item->likesCount();

        return response()->json([
            'success' => true,
            'likes_count' => $likesCount,
            'liked' => $like ? false : true,
        ]);

    }

}


