<?php

namespace App\Services\Setting\MonthlyCustomerSetting;

// モデル
use App\Models\Customer;
use App\Models\MonthlyCustomerSetting;
// その他
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;

class MonthlyCustomerSettingCreateRecordService
{
    // 有効な荷主を取得
    public function getAvailableCustomer($base_id)
    {
        return Customer::where('base_id', $base_id)
                            ->where('is_available', 1)
                            ->pluck('customer_id');
    }

    // 追加する設定行の情報を取得
    public function getCreateRecordInfo($base_id, $create_ym, $customers)
    {
        // テーブルから追加予定の条件のレコードを取得
        $monthly_customer_settings = MonthlyCustomerSetting::where('monthly_customer_setting_ym', $create_ym)
                                                            ->whereHas('dbs_customer.dbs_base', function ($query) use($base_id) {
                                                                $query->where('base_id', $base_id);
                                                            })
                                                            ->pluck('customer_id');
        // $customersから$monthly_customer_settingsを除いた結果を取得（残った結果が追加されていない荷主となる）
        return $customers->diff($monthly_customer_settings);
    }

    // 設定行を追加
    public function createRecord($create_ym, $create_records)
    {
        foreach($create_records as $create_record){
            MonthlyCustomerSetting::create([
                'customer_id' => $create_record,
                'monthly_customer_setting_ym' => $create_ym,
            ]);
        }
        return;
    }
}