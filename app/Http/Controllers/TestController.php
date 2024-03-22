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
use App\Models\KintaiHoliday;
use App\Models\MonthlyCostSetting;
// その他
use Carbon\CarbonImmutable;

class TestController extends Controller
{
    public function balance_create(Request $request)
    {
        // 収支を作成する月を取得
        $create_month = '2024-03';
        // 収支作成が有効な荷主を取得
        $monthly_customer_settings = MonthlyCustomerSetting::where('balance_create_is_available', 1)->get();
        // 収支を作成する期間の日付を取得
        $create_start_date = CarbonImmutable::parse($create_month)->startOfMonth();
        $create_end_date = CarbonImmutable::parse($create_month)->endOfMonth();
        // ループ処理で使用する変数に開始する日付を格納
        $current_date = CarbonImmutable::parse($create_start_date);
        // 開始日から終了日までをループ処理
        while ($current_date <= $create_end_date) {
            // 収支枠を作成
            foreach($monthly_customer_settings as $monthly_customer_setting){
                // 収支IDを取得
                $balance_id = $monthly_customer_setting->customer_id.'_'.$current_date->format('Y-m-d');
                // 収支IDが存在しなければ各収支枠を作成
                if(!Balance::getSpecify($balance_id)->first()){
                    Balance::create([
                        'balance_id' => $balance_id,
                        'customer_id' => $monthly_customer_setting->customer_id,
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
        $date = '2024-03-01';
        // 指定した日付の荷主稼働時間を従業員区分毎に集計して取得
        $kintais = KintaiKintai::getCustomerWorkingTimeByEmployeeCategoryId($date)->get();
        // 勤怠の分だけループ処理
        foreach($kintais as $kintai){
            // 更新対象の収支を取得
            $balance = Balance::where('balance_date', $date)->where('customer_id', $kintai->customer_id)->first();
            // 収支が存在していたら
            if($balance){
                // 従業員区分毎で設定を区別
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
                // 人件費を更新
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
        // 荷主を全て取得
        $customers = Customer::getAll()->get();
        // 作成する月を取得
        $create_month = '2024-03-01';
        // 荷主の分だけループ処理
        foreach($customers as $customer){
            // 月別荷主設定を作成
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

    public function sales_cost_allocation()
    {
        // 分配する月を取得
        $allocation_month = '2024-03-01';
        // 月の開始・終了日を取得
        $allocation_start_date = CarbonImmutable::parse($allocation_month)->startOfMonth();
        $allocation_end_date = CarbonImmutable::parse($allocation_month)->endOfMonth();
        // ループ処理で使用する変数に開始する日付を格納
        $current_date = CarbonImmutable::parse($allocation_start_date);
        // 分配する日付を格納する配列を初期化
        $allocation_date = [];
        // 開始日から終了日までをループ処理
        while ($current_date <= $allocation_end_date) {
            // 平日の場合
            if ($current_date->isWeekday()) {
                // 分配する日付を配列に格納
                $allocation_date[] = $current_date->format('Y-m-d');
            }
            // 日付を1日足す
            $current_date = $current_date->addDay();
        }
        // 指定した期間の休日情報を取得
        $holidays = KintaiHoliday::whereDate('holiday', '>=', $allocation_start_date)
                            ->whereDate('holiday', '<=', $allocation_end_date)
                            ->get();
        // 休日の分だけループ処理
        foreach($holidays as $holiday){
            // 休日が平日の場合
            if(CarbonImmutable::parse($holiday->holiday)->isWeekday()){
                // 指定した日付が分配する配列に存在しているか取得
                $index = array_search($holiday->holiday, $allocation_date);
                // 存在していた場合、配列から日付を削除
                if ($index !== false) {
                    unset($allocation_date[$index]);
                }
            }
        }
        // 分配する拠点を取得
        $allocation_base_id = '08_LC';
        // 拠点の分配対象月の月額経費設定を取得
        $monthly_cost_setting = MonthlyCostSetting::where('base_id', $allocation_base_id)
                                    ->where('monthly_cost_setting_ym', $allocation_month)
                                    ->first();
        // 月別荷主設定を取得
        $monthly_customer_settings = MonthlyCustomerSetting::where('monthly_customer_setting_ym', $allocation_month)
                                        ->join('customers', 'customers.customer_id', 'monthly_customer_settings.customer_id')
                                        ->where('base_id', $allocation_base_id)
                                        ->where('balance_create_is_available', 1)
                                        ->get();
        // 月別荷主設定の分だけループ処理
        foreach($monthly_customer_settings as $monthly_customer_setting){
            // 分配対象のレコードを取得
            $balances = Balance::whereIn('balance_date', $allocation_date)
                            ->where('customer_id', $monthly_customer_setting->customer_id)
                            ->get();
            // 1日分の保管売上・経費金額を取得
            $daily_amount_storage_sales = $this->getDailyAmount($monthly_customer_setting->monthly_storage_sales, count($allocation_date));
            $daily_amount_storage_cost = $this->getDailyAmount($monthly_customer_setting->monthly_storage_cost, count($allocation_date));
            // 1ヶ月分の本社管理費・月額経費金額を取得
            $monthly_amount_ho_cost = $monthly_customer_setting->ho_cost_allocation_ratio > 0 && $monthly_cost_setting->ho_cost > 0 ? round($monthly_cost_setting->ho_cost * ($monthly_customer_setting->ho_cost_allocation_ratio / 100)) : 0;
            $monthly_amount_monthly_cost = $monthly_customer_setting->monthly_cost_allocation_ratio > 0 && $monthly_cost_setting->monthly_cost > 0 ? round($monthly_cost_setting->monthly_cost * ($monthly_customer_setting->monthly_cost_allocation_ratio / 100)) : 0;
            // 1日分の本社管理費・月額経費金額を取得
            $daily_amount_ho_cost = $this->getDailyAmount($monthly_amount_ho_cost, count($allocation_date));
            $daily_amount_monthly_cost = $this->getDailyAmount($monthly_amount_monthly_cost, count($allocation_date));
            // 収支枠の分だけループ処理
            foreach($balances as $balance){
                // 保管売上・経費を分配
                BalanceStorage::where('balance_id', $balance->balance_id)->update([
                    'storage_sales' => $daily_amount_storage_sales,
                    'storage_cost' => $daily_amount_storage_cost,
                ]);
                // 本社管理費・月額経費を分配
                BalanceMonthlyCost::where('balance_id', $balance->balance_id)->update([
                    'ho_cost' => $daily_amount_ho_cost,
                    'monthly_cost' => $daily_amount_monthly_cost,
                ]);
            }
        }
        return redirect()->back()->with([
            'alert_type' => 'success',
            'alert_message' => '売上・経費を分配しました。',
        ]);
    }

    // 1日分の金額を取得
    public function getDailyAmount($amount, $weekdays)
    {
        // 金額が0であれば、0を返す
        if($amount == 0){
            return 0;
        }
        // 金額を平日の日数で割る(小数点第一位を四捨五入)
        return round($amount / $weekdays, 0);
    }
}
