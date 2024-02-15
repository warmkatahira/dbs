<?php

namespace App\Services\BalanceMgt\BalanceList;

// その他
use Carbon\CarbonImmutable;

class CalendarService
{
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
            // 7回ループし、1週間の日付を配列に格納
            for ($i = 0; $i < 7; $i++) {
                $week_date[] = $current_date->toDateString();
                $current_date = $current_date->addDay();
            }
            // 月の配列に週単位の情報を格納
            $month_date[] = $week_date;
        }
        return $month_date;
    }
}