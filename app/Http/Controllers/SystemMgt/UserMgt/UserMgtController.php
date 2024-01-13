<?php

namespace App\Http\Controllers\SystemMgt\UserMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\User;

class UserMgtController extends Controller
{
    public function index(Request $request)
    {
        // 拠点を全て取得
        $users = User::getAll()->get();
        return view('system_mgt.user_mgt.index')->with([
            'users' => $users,
        ]);
    }
}
