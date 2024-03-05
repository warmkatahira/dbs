<?php

namespace App\Services\BalanceMgt\BalanceList;

// モデル
use App\Models\Balance;
// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
// 列挙
use App\Enums\BalanceMgt\BalanceList\SortFieldConditionsEnum;
use App\Enums\BalanceMgt\BalanceList\DispNumConditionsEnum;
use App\Enums\SortDirectionConditionsEnum;

class CalendarService
{
    // 表示する情報をセッションに格納
    public function setDisplayInfo($request)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($request->search_enter)){
            session(['search_month' => CarbonImmutable::now()->startOfMonth()->format('Y-m')]);
            session(['search_base_id' => Auth::user()->base_id]);
            session(['search_customer_id' => null]);
            session(['search_sort_field' => SortFieldConditionsEnum::SALES]);
            session(['search_sort_direction' => SortDirectionConditionsEnum::DESC]);
            session(['search_disp_num' => DispNumConditionsEnum::DISP_03]);
        }
        // nullではなかったら検索が実行されているので、指定された条件を格納
        if(!is_null($request->search_enter)){
            session(['search_month' => $request->search_month]);
            session(['search_base_id' => $request->search_base_id]);
            session(['search_customer_id' => $request->search_customer_id]);
            session(['search_sort_field' => is_null($request->search_sort_field) ? SortFieldConditionsEnum::SALES : $request->search_sort_field]);
            session(['search_sort_direction' => is_null($request->search_sort_direction) ? SortDirectionConditionsEnum::DESC : $request->search_sort_direction]);
            session(['search_disp_num' => is_null($request->search_disp_num) ? DispNumConditionsEnum::DISP_03 : $request->search_disp_num]);
        }
        return;
    }

    // カレンダー表示に使用する日付を取得
    public function getStartEndDate($date)
    {
        // 指定された月の月初と月末の日付を取得
        $start_date = CarbonImmutable::parse($date)->startOfMonth();
        $end_date = CarbonImmutable::parse($date)->endOfMonth();
        // 月初の日付が月曜日でない場合、直前の月曜日を取得する
        while($start_date->dayOfWeek != CarbonImmutable::MONDAY){
            $start_date = $start_date->subDay();
        }
        // 月末の日付が日曜日でない場合、次の日曜日を取得する
        while ($end_date->dayOfWeek != CarbonImmutable::SUNDAY) {
            $end_date = $end_date->addDay();
        }
        return compact('start_date', 'end_date');
    }

    // 指定した月の情報を取得
    public function getMonthInfo($start_end_date)
    {
        // 月の日付を格納する配列を初期化
        $month_date = [];
        // ループ処理で使用する変数に開始する日付を格納
        $current_date = CarbonImmutable::parse($start_end_date['start_date']);
        // 開始日から終了日までの間の日付を配列に格納
        while ($current_date <= $start_end_date['end_date']) {
            // 週の日付を格納する配列を初期化
            $week_date = [];
            // 7回ループする（1週間分の日付）
            for ($i = 0; $i < 7; $i++) {
                // 日付と背景色を週の配列に格納
                $week_date[$current_date->isoFormat('YYYY/MM/DD')] = [];
                // 日付を1日足す
                $current_date = $current_date->addDay();
            }
            // 月の配列に週単位の情報を格納
            $month_date[] = $week_date;
        }
        return $month_date;
    }

    // カレンダーに表示する情報を取得
    public function getCalendarInfo($month_date)
    {
        // カレンダーに表示する情報を格納する配列を初期化
        $calendar_info = [];
        // 週毎にループ処理
        foreach($month_date as $week_date){
            // 週単位の情報を格納する配列を初期化
            $week_info = [];
            // 日毎にループ処理
            foreach($week_date as $key => $value){
                // 日付をフォーマット
                $date = CarbonImmutable::parse($key)->format('Y-m-d');
                // 指定された条件の収支を取得(指定された並び替え項目・並び順順序で並べる)
                $balances = Balance::join('customers', 'customers.customer_id', 'balances.customer_id')
                                ->join('bases', 'bases.base_id', 'customers.base_id')
                                ->where('balance_date', $date)
                                ->orderBy(session('search_sort_field'), session('search_sort_direction'));
                // 拠点条件がある場合
                if(session('search_base_id') != null){
                    $balances->where('customers.base_id', session('search_base_id'));
                }
                // 荷主条件がある場合
                if(session('search_customer_id') != null){
                    $balances->where('balances.customer_id', session('search_customer_id'));
                }
                /***********************************************
                 * 全体の情報
                 ***********************************************/
                // 収支登録数を取得
                $balance_count = $balances->count();
                // 全体の売上合計を取得
                $total_sales = $balances->sum('sales');
                // 全体の経費合計を取得
                $total_cost = $balances->sum('cost');
                // 全体の利益合計を取得
                $total_profit = $balances->sum('profit');
                /***********************************************
                 * 上位X件の情報(表示件数条件により件数が可変)
                 ***********************************************/
                // 収支を取得
                $disp_balances = $balances->take(session('search_disp_num'))->get()->toArray();
                /***********************************************
                 * 上位X件以外の情報(表示件数条件により件数が可変)
                 ***********************************************/
                // 収支を取得
                $other_balances = $balances->skip(session('search_disp_num'))->get();
                // 売上合計を取得
                $other_balances_total_sales = $other_balances->sum('sales');
                // 経費合計を取得
                $other_balances_total_cost = $other_balances->sum('cost');
                // 利益合計を取得
                $other_balances_total_profit = $other_balances->sum('profit');
                // 配列に変換して取得
                $other_balances = $other_balances->toArray();
                // 収支情報を週単位の配列に格納
                $week_info[$date] = 
                    [
                        'disp_balances' => $disp_balances,
                        'other_balances' => $other_balances,
                        'balance_count' => $balance_count,
                        'total_sales' => $total_sales,
                        'total_cost' => $total_cost,
                        'total_profit' => $total_profit,
                        'other_balances_total_sales' => $other_balances_total_sales,
                        'other_balances_total_cost' => $other_balances_total_cost,
                        'other_balances_total_profit' => $other_balances_total_profit,
                    ];
            }
            // 週単位の配列を全体の配列に格納
            $calendar_info[] = $week_info;
        }
        return $calendar_info;
    }
}