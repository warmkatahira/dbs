<?php

namespace App\Services\MasterMgt\HandlingFeeSetting;

// モデル
use App\Models\Customer;

class HandlingFeeSettingCreateService
{
    public function createCustomerHandling($request)
    {
        // 追加
        Customer::where('customer_id', $request->customer_id)->first()->handlings()->attach($request->handling_id,
            [
                'handling_fee_unit_price' => $request->handling_fee_unit_price,
                'handling_fee_note' => $request->handling_fee_note,
                'handling_fee_sort_order' => $request->handling_fee_sort_order,
            ]
        );
        return;
    }
}