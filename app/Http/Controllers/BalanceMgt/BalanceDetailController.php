<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Balance;
// サービス
use App\Services\BalanceMgt\BalanceDetail\BalanceDetailService;

class BalanceDetailController extends Controller
{
    public function index(Request $request)
    {
        // 現在のURLを取得
        session(['back_url_2' => url()->full()]);
        // インスタンス化
        $BalanceDetailService = new BalanceDetailService;
        // 収支を取得
        $balance = Balance::getSpecify($request->balance_id)->first();
        // 人件費を取得
        $balance_labor_cost = $balance->balance_labor_cost()->first();
        // 月額経費を取得
        $balance_monthly_cost = $balance->balance_monthly_cost()->first();
        // 保管売上・経費を取得
        $balance_storage = $balance->balance_storage()->first();
        return view('balance_mgt.balance_detail.index')->with([
            'balance' => $balance,
            'balance_labor_cost' => $balance_labor_cost,
            'balance_monthly_cost' => $balance_monthly_cost,
            'balance_storage' => $balance_storage,
        ]);
    }
}
