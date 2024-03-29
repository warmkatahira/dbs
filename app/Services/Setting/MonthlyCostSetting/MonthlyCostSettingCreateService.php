<?php

namespace App\Services\Setting\MonthlyCostSetting;

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
            'ho_cost' => $request->ho_cost,
            'monthly_cost' => $request->monthly_cost,
        ]);
        return;
    }
}