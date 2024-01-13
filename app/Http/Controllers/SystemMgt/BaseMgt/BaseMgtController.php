<?php

namespace App\Http\Controllers\SystemMgt\BaseMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\SystemMgt\BaseMgt\BaseSyncService;

class BaseMgtController extends Controller
{
    public function index(Request $request)
    {
        // 拠点を全て取得
        $bases = Base::getAll()->get();
        return view('system_mgt.base_mgt.index')->with([
            'bases' => $bases,
        ]);
    }

    public function sync()
    {
        // インスタンス化
        $BaseSyncSerivce = new BaseSyncService;
        // DB:kintaiのbasesテーブルと同期
        $BaseSyncSerivce->syncBase();
        return back()->with([
            'alert_type' => 'success',
            'alert_message' => '拠点同期が完了しました。',
        ]);
    }
}
