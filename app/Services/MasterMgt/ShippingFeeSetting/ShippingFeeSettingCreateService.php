<?php

namespace App\Services\MasterMgt\ShippingFeeSetting;

// モデル
use App\Models\Customer;

class ShippingFeeSettingCreateService
{
    public function createCustomerShippingMethod($request)
    {
        // 追加
        Customer::where('customer_id', $request->customer_id)->first()->shipping_methods()->attach($request->shipping_method_id,
            [
                'shipping_fee_unit_price_sales' => $request->shipping_fee_unit_price_sales,
                'shipping_fee_unit_price_cost' => $request->shipping_fee_unit_price_cost,
                'shipping_fee_note' => $request->shipping_fee_note,
            ]
        );
        return;
    }
}