<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_id'];

    /**
     * Userモデルとのリレーション設定
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
    /**
     * Itemモデルとのリレーション設定
     */
    public function item() {
        return $this->belongsTo(Item::class);
    }
}
