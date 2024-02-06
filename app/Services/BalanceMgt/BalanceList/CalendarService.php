<?php

namespace App\Services\BalanceMgt\BalanceList;

// その他
use Carbon\CarbonImmutable;

class CalendarService
{
    // 指定した月の情報を取得
    public function getMonthInfo($date)
    {
        // 月初と月末の日付を取得
        $start_day = CarbonImmutable::parse($date)->startOfMonth();
        $end_day = CarbonImmutable::parse($date)->endOfMonth();
        // 月初の日付が月曜日でない場合、前月最後の月曜日に戻る
        while($start_day->dayOfWeek != CarbonImmutable::MONDAY){
            $start_day = $start_day->subDay();
        }
        // 月の日数を取得
        $days_in_month = $start_day->daysInMonth;
        // 日付を格納するの配列を初期化
        $month_info = [];
        // 月の日数分だけループ処理
        for($i = 0;$i < $days_in_month;$i++){
            // 月初の日付にループ変数分を足して日付を生成
            $current_date = $start_day->addDay($i)->toDateString();
            // 週ごとのサブ配列がまだ作成されていない場合、新しい配列を作成
            if (!isset($month_info[$current_date->weekOfMonth()])) {
                $month_info[$current_date->weekOfMonth()] = [];
            }
            dd($month_info);
            $month_info[] = $current_date;
        }
        return $month_info;
    }
}