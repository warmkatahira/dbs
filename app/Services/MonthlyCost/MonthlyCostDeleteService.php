<?php

namespace App\Services\MonthlyCost;

// モデル
use App\Models\MonthlyCost;

class MonthlyCostDeleteService
{
    // 削除処理
    public function deleteMonthlyCost($monthly_cost_id)
    {
        MonthlyCost::where('monthly_cost_id', $monthly_cost_id)->delete();
        return;
    }
}