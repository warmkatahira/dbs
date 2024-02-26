<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
use App\Models\Customer;
// サービス
use App\Services\BalanceMgt\BalanceList\CalendarService;

class BalanceListController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $CalendarService = new CalendarService;
        // 表示する情報をセッションに格納
        $CalendarService->setDisplayInfo($request);
        // 指定した月の情報を取得
        $month_date = $CalendarService->getMonthInfo(session('search_month'));
        // 拠点を取得
        $bases = Base::getall()->get();
        // 指定した拠点の有効な荷主を全て取得
        $customers = Customer::getAllByBase(session('search_base_id'))->get();
        return view('balance_mgt.balance_list.index')->with([
            'month_date' => $month_date,
            'bases' => $bases,
            'customers' => $customers,
        ]);
    }
}
