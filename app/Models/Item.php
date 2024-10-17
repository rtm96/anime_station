<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'detail',
        'videoURL',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * いいね機能のリレーション設定
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * 特定ユーザーがいいねをしているかどうかを確認する
     */
    public function isLikedBy(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    /**
     * いいね数を返すメソッドを追加
     */
    public function likesCount()
    {
        return $this->likes()->count();
    }
}
