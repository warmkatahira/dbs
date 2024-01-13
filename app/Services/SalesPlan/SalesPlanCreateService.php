<?php

namespace App\Services\SalesPlan;

// モデル
use App\Models\SalesPlan;
// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class SalesPlanCreateService
{
    // 登録処理
    public function createSalesPlan($request)
    {
        SalesPlan::create([
            'base_id' => Auth::user()->base_id,
            'sales_plan_ym' => CarbonImmutable::createFromFormat('Y-m', $request->sales_plan_ym)->startOfMonth(), // 1日の日付で登録する
            'sales_plan' => $request->sales_plan,
        ]);
        return;
    }
}