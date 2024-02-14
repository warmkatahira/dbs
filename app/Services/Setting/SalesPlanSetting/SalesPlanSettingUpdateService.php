<?php

namespace App\Services\Setting\SalesPlanSetting;

// モデル
use App\Models\SalesPlanSetting;

class SalesPlanSettingUpdateService
{
    // 更新処理
    public function updateSalesPlanSetting($request)
    {
        SalesPlanSetting::where('sales_plan_setting_id', session('sales_plan_setting_id'))->update([
            'sales_plan' => $request->sales_plan,
        ]);
        return;
    }
}