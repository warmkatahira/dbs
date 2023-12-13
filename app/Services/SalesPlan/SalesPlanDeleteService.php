<?php

namespace App\Services\MasterMgt\Base\SalesPlan;

// モデル
use App\Models\SalesPlan;

class SalesPlanDeleteService
{
    // 削除処理
    public function deleteSalesPlan($sales_plan_id)
    {
        SalesPlan::where('sales_plan_id', $sales_plan_id)->delete();
        return;
    }
}