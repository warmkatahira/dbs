<?php

namespace App\Services\MasterMgt\Base\SalesPlan;

// モデル
use App\Models\SalesPlan;
// その他
use Carbon\CarbonImmutable;

class SalesPlanUpdateService
{
    // 更新処理
    public function updateSalesPlan($request)
    {
        SalesPlan::where('sales_plan_id', session('sales_plan_id'))->update([
            'sales_plan' => $request->sales_plan,
        ]);
        return;
    }
}