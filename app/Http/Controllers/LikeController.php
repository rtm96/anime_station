<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($itemId)
    {
        Auth::user()->like($itemId);
        return 'ok!'; //レスポンス内容
    }

    public function destroy($itemId)
    {
        Auth::user()->unlike($itemId);
        return 'ok!'; //レスポンス内容
    }
}
