<?php

namespace App\Services\MasterMgt\HandlingFeeSetting;

// モデル
use App\Models\CustomerHandling;

class HandlingFeeSettingUpdateService
{
    public function updateCustomerHandling($request)
    {
        // 更新
        CustomerHandling::where('customer_handling_id', $request->customer_handling_id)->update([
            'handling_id' => $request->handling_id,
            'handling_fee_unit_price' => $request->handling_fee_unit_price,
            'handling_fee_note' => $request->handling_fee_note,
            'handling_fee_sort_order' => $request->handling_fee_sort_order,
        ]);
        return;
    }
}