<?php

namespace App\Http\Controllers\MasterMgt\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\MasterMgt\Base\BaseSyncService;

class BaseController extends Controller
{
    public function index(Request $request)
    {
        // 拠点を全て取得
        $bases = Base::getAll()->get();
        return view('master_mgt.base.index')->with([
            'bases' => $bases,
        ]);
    }

    public function sync()
    {
        // インスタンス化
        $BaseSyncSerivce = new BaseSyncService;
        // DB:kintaiのbasesテーブルと同期
        $BaseSyncSerivce->syncBase();
        return back();
    }
}
