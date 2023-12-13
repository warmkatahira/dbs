<?php

namespace App\Services\MonthlyCost;

// モデル
use App\Models\MonthlyCost;
// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class MonthlyCostCreateService
{
    // 登録処理
    public function createMonthlyCost($request)
    {
        MonthlyCost::create([
            'base_id' => Auth::user()->base_id,
            'monthly_cost_ym' => CarbonImmutable::createFromFormat('Y-m', $request->monthly_cost_ym)->startOfMonth(), // 1日の日付で登録する
            'monthly_cost_item_id' => $request->monthly_cost_item_id,
            'monthly_cost' => $request->monthly_cost,
        ]);
        return;
    }
}