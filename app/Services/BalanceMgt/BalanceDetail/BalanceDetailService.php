<?php

namespace App\Services\BalanceMgt\BalanceDetail;

// モデル
use App\Models\Balance;
use App\Models\Customer;
// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class BalanceDetailService
{
    // 収支の情報を取得
    public function getBalanceData($balance_id)
    {
        // 収支を取得
        $balance = Balance::getSpecify($balance_id)->first();
        // 人件費を取得
        $balance_labor_cost = $balance->balance_labor_cost()->first();
        // 月額経費を取得
        $balance_monthly_cost = $balance->balance_monthly_cost()->first();
        // 保管売上・経費を取得
        $balance_storage = $balance->balance_storage()->first();
        // 荷主を取得
        $customer = Customer::getSpecify($balance->customer_id)->first();
        // 運賃設定を取得
        $customer_shipping_methods = $customer->shipping_methods()->get();
        // 現在登録されている運賃を取得
        $balance_shipping_fees = $balance->balance_shipping_fees()->get();
        // 荷役設定を取得
        $customer_handlings = $customer->handlings()->get();
        // 現在登録されている荷役を取得
        $balance_handling_fees = $balance->balance_handling_fees()->get();
        return compact(
            'balance',
            'balance_labor_cost',
            'balance_monthly_cost',
            'balance_storage',
            'customer_shipping_methods',
            'balance_shipping_fees',
            'customer_handlings',
            'balance_handling_fees'
        );
    }
}