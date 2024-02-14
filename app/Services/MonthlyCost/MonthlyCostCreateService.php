<?php

namespace App\Services\MonthlyCostSetting;

// モデル
use App\Models\MonthlyCostSetting;
// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class MonthlyCostSettingCreateService
{
    // 登録処理
    public function createMonthlyCostSetting($request)
    {
        MonthlyCostSetting::create([
            'base_id' => Auth::user()->base_id,
            'monthly_cost_setting_ym' => CarbonImmutable::createFromFormat('Y-m', $request->monthly_cost_setting_ym)->startOfMonth(), // 1日の日付で登録する
            'monthly_cost_setting_item_id' => $request->monthly_cost_setting_item_id,
            'monthly_cost_setting' => $request->monthly_cost_setting,
        ]);
        return;
    }
}