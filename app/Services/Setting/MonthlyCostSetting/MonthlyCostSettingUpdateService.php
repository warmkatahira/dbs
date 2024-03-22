<?php

namespace App\Services\Setting\MonthlyCostSetting;

// モデル
use App\Models\MonthlyCostSetting;

class MonthlyCostSettingUpdateService
{
    // 更新処理
    public function updateMonthlyCostSetting($request)
    {
        MonthlyCostSetting::where('monthly_cost_setting_id', session('monthly_cost_setting_id'))->update([
            'ho_cost' => $request->ho_cost,
            'monthly_cost' => $request->monthly_cost,
        ]);
        return;
    }
}