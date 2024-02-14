<?php

namespace App\Services\Setting\MonthlyCostSetting;

// モデル
use App\Models\MonthlyCostSetting;

class MonthlyCostSettingDeleteService
{
    // 削除処理
    public function deleteMonthlyCostSetting($monthly_cost_setting_id)
    {
        MonthlyCostSetting::where('monthly_cost_setting_id', $monthly_cost_setting_id)->delete();
        return;
    }
}