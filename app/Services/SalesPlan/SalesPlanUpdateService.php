<?php

namespace App\Services\SalesPlanSetting;

// モデル
use App\Models\SalesPlanSetting;

class SalesPlanSettingUpdateService
{
    // 更新処理
    public function updateSalesPlanSetting($request)
    {
        SalesPlanSetting::where('sales_plan_setting_id', session('sales_plan_setting_id'))->update([
            'sales_plan_setting' => $request->sales_plan_setting,
        ]);
        return;
    }
}