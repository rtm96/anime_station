<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * プロフィール画面
     */
    public function index()
    {
        return view('item.index');
    }
}
