<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        // 収支の情報を取得
        $balance_data = $BalanceDetailService->getBalanceData($request->balance_id);
        return view('balance_mgt.balance_detail.index')->with([
            'balance_data' => $balance_data,
        ]);
    }
}
