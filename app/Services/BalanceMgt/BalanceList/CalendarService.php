<?php

namespace App\Services\BalanceMgt\BalanceList;

// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class CalendarService
{
    // 表示する情報をセッションに格納
    public function setDisplayInfo($request)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($request->search_enter)){
            session(['search_month' => CarbonImmutable::now()->startOfMonth()->format('Y-m-d')]);
            session(['search_base' => Auth::user()->base_id]);
            session(['search_customer' => null]);
        }
        // nullではなかったら検索が実行されているので、指定された条件を格納
        if(!is_null($request->search_enter)){
            session(['search_month' => $request->search_month]);
            session(['search_base' => $request->search_base]);
            session(['search_customer' => $request->search_customer]);
        }
        return;
    }

    // 指定した月の情報を取得
    public function getMonthInfo($date)
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
        // 月の日付を格納する配列を初期化
        $month_date = [];
        // 開始する日付を格納
        $current_date = CarbonImmutable::parse($start_date);
        // 開始日から終了日までの間の日付を配列に格納
        while ($current_date <= $end_date) {
            // 週の日付を格納する配列を初期化
            $week_date = [];
            // 7回ループする（1週間分の日付）
            for ($i = 0; $i < 7; $i++) {
                // 土曜日と日曜日だったら、カレンダーの背景色を設定
                $bg = '';
                if($current_date->dayOfWeek == CarbonImmutable::SATURDAY){
                    $bg = 'bg-blue-200';
                }
                if($current_date->dayOfWeek == CarbonImmutable::SUNDAY){
                    $bg = 'bg-pink-200';
                }
                // 日付と背景色を週の配列に格納
                $week_date[] = [
                    'date' => $current_date->toDateString(),
                    'bg' => $bg,
                ];
                // 日付を1日足す
                $current_date = $current_date->addDay();
            }
            // 月の配列に週単位の情報を格納
            $month_date[] = $week_date;
        }
        return $month_date;
    }
}