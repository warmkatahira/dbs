<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル

// サービス
use App\Services\BalanceMgt\BalanceList\CalendarService;

class BalanceListController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $CalendarService = new CalendarService;
        // 指定した月の情報を取得
        $month_date = $CalendarService->getMonthInfo('2024-02-01');
        return view('balance_mgt.balance_list.index')->with([
            'month_date' => $month_date,
        ]);
    }
}
