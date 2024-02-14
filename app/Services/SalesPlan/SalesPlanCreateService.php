<?php

namespace App\Services\SalesPlanSetting;

// モデル
use App\Models\SalesPlanSetting;
// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class SalesPlanSettingCreateService
{
    // 登録処理
    public function createSalesPlanSetting($request)
    {
        SalesPlanSetting::create([
            'base_id' => Auth::user()->base_id,
            'sales_plan_setting_ym' => CarbonImmutable::createFromFormat('Y-m', $request->sales_plan_setting_ym)->startOfMonth(), // 1日の日付で登録する
            'sales_plan_setting' => $request->sales_plan_setting,
        ]);
        return;
    }
}