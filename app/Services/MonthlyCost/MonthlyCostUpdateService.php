<?php

namespace App\Services\MonthlyCost;

// モデル
use App\Models\MonthlyCost;

class MonthlyCostUpdateService
{
    // 更新処理
    public function updateMonthlyCost($request)
    {
        MonthlyCost::where('monthly_cost_id', session('monthly_cost_id'))->update([
            'monthly_cost' => $request->monthly_cost,
        ]);
        return;
    }
}