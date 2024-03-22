<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\BalanceLaborCost;
use App\Models\BalanceMonthlyCost;
use App\Models\BalanceStorage;
// サービス
use App\Services\BalanceMgt\BalanceDetail\BalanceDetailService;

class BalanceDetailController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $BalanceDetailService = new BalanceDetailService;
        // 人件費を取得
        $balance_labor_cost = BalanceLaborCost::getSpecifyByBalanceId($request->balance_id)->first();
        // 月額経費を取得
        $balance_monthly_cost = BalanceMonthlyCost::getSpecifyByBalanceId($request->balance_id)->first();
        // 保管売上・経費を取得
        $balance_storage = BalanceStorage::getSpecifyByBalanceId($request->balance_id)->first();
        return view('balance_mgt.balance_detail.index')->with([
            'balance_labor_cost' => $balance_labor_cost,
            'balance_monthly_cost' => $balance_monthly_cost,
            'balance_storage' => $balance_storage,
        ]);
    }
}
