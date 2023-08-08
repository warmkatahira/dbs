<?php

namespace App\Services\MasterMgt\Base\SalesPlan;

// モデル
use App\Models\SalesPlan;
// その他
use Carbon\CarbonImmutable;

class SalesPlanCreateService
{
    // 登録処理
    public function createSalesPlan($request)
    {
        SalesPlan::create([
            'base_id' => session('search_base_id'),
            'sales_plan_ym' => CarbonImmutable::createFromFormat('Y-m', $request->sales_plan_ym)->startOfMonth(), // 1日の日付で登録する
            'sales_plan' => $request->sales_plan,
        ]);
        return;
    }
}