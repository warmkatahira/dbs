<?php

namespace App\Services\SalesPlanSetting;

// モデル
use App\Models\SalesPlanSetting;

class SalesPlanSettingDeleteService
{
    // 削除処理
    public function deleteSalesPlanSetting($sales_plan_setting_id)
    {
        SalesPlanSetting::where('sales_plan_setting_id', $sales_plan_setting_id)->delete();
        return;
    }
}