<?php

namespace App\Services\MonthlyCostSetting;

// モデル
use App\Models\MonthlyCostSetting;

class MonthlyCostSettingUpdateService
{
    // 更新処理
    public function updateMonthlyCostSetting($request)
    {
        MonthlyCostSetting::where('monthly_cost_setting_id', session('monthly_cost_setting_id'))->update([
            'monthly_cost_setting' => $request->monthly_cost_setting,
        ]);
        return;
    }
}