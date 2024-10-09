<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function favorite(Request $request, Item $item){
        // 認証済みユーザーを取得
        $user = Auth::user();

        if ($user) {
            // Userのid取得
            $user_id = Auth::id();

            // 既にいいねしているかチェック
            $existingFavorite = Like::where('item_id', $item->id)
                ->where('user_id', $user_id)
                ->first();

            // 既にいいねしている場合は何もせず、そうでない場合は新しいいいねを作成する
            if (!$existingFavorite) {
                $favorite = new Like();
                $favorite->article_id = $item->id;
                $favorite->user_id = $user_id;
                $favorite->save();
            }

            // ポストの状態を返す
            return response()->json([
                'item' => [
                    'slug' => $item->slug,
                    'title' => $item->title,
                    'description' => $item->description,
                    'body' => $item->body,
                    'tagList' => $item->tags->pluck('name'),
                    'createdAt' => $item->created_at,
                    'updatedAt' => $item->updated_at,
                    'liked' => true, // いいねされた状態を示す
                    'likeCount' => $item->likes()->count(), // いいねの合計数を取得
                ]
            ]);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }
}
