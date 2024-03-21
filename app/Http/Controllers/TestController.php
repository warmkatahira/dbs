<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\Balance;
use App\Models\BalanceLaborCost;
use App\Models\BalanceStorage;
use App\Models\BalanceMonthlyCost;
use App\Models\KintaiKintai;
use App\Models\MonthlyCustomerSetting;
// その他
use Carbon\CarbonImmutable;

class TestController extends Controller
{
    public function balance_create(Request $request)
    {
        // 収支作成が有効な荷主を取得
        $customers = Customer::where('is_available', 1)
                        ->where('balance_create_is_available', 1)
                        ->get();
        // 収支を作成する月を取得
        $create_month = '2024-03';
        // 収支を作成する期間の日付を取得
        $create_start_date = CarbonImmutable::parse($create_month)->startOfMonth()->format('Y-m-d');
        $create_end_date = CarbonImmutable::parse($create_month)->endOfMonth()->format('Y-m-d');
        // ループ処理で使用する変数に開始する日付を格納
        $current_date = CarbonImmutable::parse($create_start_date);
        // 開始日から終了日までの間の日付を配列に格納
        while ($current_date <= $create_end_date) {
            // 収支枠を作成
            foreach($customers as $customer){
                $balance_id = $customer->customer_id.'_'.$current_date->format('Y-m-d');
                Balance::create([
                    'balance_id' => $balance_id,
                    'customer_id' => $customer->customer_id,
                    'balance_date' => $current_date->format('Y-m-d'),
                ]);
                BalanceLaborCost::create([
                    'balance_id' => $balance_id,
                ]);
                BalanceStorage::create([
                    'balance_id' => $balance_id,
                ]);
                BalanceMonthlyCost::create([
                    'balance_id' => $balance_id,
                ]);
            }
            // 日付を1日足す
            $current_date = $current_date->addDay();
        }
        return redirect()->back()->with([
            'alert_type' => 'success',
            'alert_message' => '収支枠を作成しました。',
        ]);
    }

    public function labor_cost_update()
    {
        // 人件費を更新する日付を取得
        $date = '2024-03-15';
        // 指定した日付の荷主稼働時間を従業員区分毎に集計して取得
        $kintais = KintaiKintai::getCustomerWorkingTimeByEmployeeCategoryId($date)->get();

        foreach($kintais as $kintai){
            $balance = Balance::where('balance_date', $date)->where('customer_id', $kintai->customer_id)->first();
            if($balance){
                if($kintai->employee_category_id == 1){
                    $update_column = 'fulltime_labor_cost';
                    $hourly_wage = 2000;
                }
                if($kintai->employee_category_id == 2){
                    $update_column = 'contract_labor_cost';
                    $hourly_wage = 1700;
                }
                if($kintai->employee_category_id == 10){
                    $update_column = 'parttime_labor_cost';
                    $hourly_wage = 1300;
                }
                BalanceLaborCost::where('balance_id', $balance->balance_id)->update([
                    $update_column => ($kintai->total_customer_working_time / 60) * $hourly_wage,
                ]);
            }
        }
        return redirect()->back()->with([
            'alert_type' => 'success',
            'alert_message' => '人件費を更新しました。',
        ]);
    }

    public function monthly_customer_setting_create()
    {
        $customers = Customer::getAll()->get();
        // 作成する月を取得
        $create_month = '2024-03-01';
        foreach($customers as $customer){
            MonthlyCustomerSetting::create([
                'customer_id' => $customer->customer_id,
                'monthly_customer_setting_ym' => $create_month,
            ]);
        }


        return redirect()->back()->with([
            'alert_type' => 'success',
            'alert_message' => '月別荷主設定を作成しました。',
        ]);
    }
}
