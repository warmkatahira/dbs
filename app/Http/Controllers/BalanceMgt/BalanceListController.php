<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
use App\Models\Customer;
// サービス
use App\Services\BalanceMgt\BalanceList\CalendarService;
// 列挙
use App\Enums\BalanceMgt\BalanceList\SortFieldConditionsEnum;
use App\Enums\BalanceMgt\BalanceList\DispNumConditionsEnum;
use App\Enums\SortDirectionConditionsEnum;

class BalanceListController extends Controller
{
    public function index(Request $request)
    {
        // インスタンス化
        $CalendarService = new CalendarService;
        // 表示する情報をセッションに格納
        $CalendarService->setDisplayInfo($request);
        // カレンダー表示に使用する日付を取得
        $start_end_date = $CalendarService->getStartEndDate(session('search_month'));
        // 指定した月の情報を取得
        $month_date = $CalendarService->getMonthInfo($start_end_date);
        // カレンダーに表示する情報を取得
        $calendar_info = $CalendarService->getCalendarInfo($month_date);
        // 拠点を取得
        $bases = Base::getall()->get();
        // 指定した拠点の有効な荷主を全て取得
        $customers = Customer::getAllByBase(session('search_base_id'))->get();
        // 並び替え項目の検索条件に使用する情報を取得
        $sort_field_conditions = SortFieldConditionsEnum::makeCondition();
        // 並び替え順序の検索条件に使用する情報を取得
        $sort_direction_conditions = SortDirectionConditionsEnum::makeCondition();
        // 表示件数の検索条件に使用する情報を取得
        $disp_num_conditions = DispNumConditionsEnum::makeCondition();
        return view('balance_mgt.balance_list.index')->with([
            'bases' => $bases,
            'customers' => $customers,
            'calendar_info' => $calendar_info,
            'sort_field_conditions' => $sort_field_conditions,
            'sort_direction_conditions' => $sort_direction_conditions,
            'disp_num_conditions' => $disp_num_conditions,
        ]);
    }
}
