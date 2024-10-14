<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'auth',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //多対多のリレーション
    public function likes()
    {
        return $this->belongsToMany('App\Models\Item','likes','user_id','item_id')->withTimestamps();
    }

     //この投稿に対して既にlikeしたかどうかを判別する
    public function isLike($itemId)
    {
    return $this->likes()->where('item_id',$itemId)->exists();
    }

    //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    public function like($itemId)
    {
        if($this->isLike($itemId)){
        //もし既に「いいね」していたら何もしない
        } else {
        $this->likes()->attach($itemId);
        }
    }

    //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    public function unlike($itemId)
    {
        if($this->isLike($itemId)){
            //もし既に「いいね」していたら消す
            $this->likes()->detach($itemId);
        } else {
        }
    }
}
