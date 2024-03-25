<?php

namespace App\Services\MasterMgt\ShippingFeeSetting;

// モデル
use App\Models\CustomerShippingMethod;

class ShippingFeeSettingUpdateService
{
    public function updateCustomerShippingMethod($request)
    {
        // 更新
        CustomerShippingMethod::where('customer_shipping_method_id', $request->customer_shipping_method_id)->update([
            'shipping_fee_unit_price_sales' => $request->shipping_fee_unit_price_sales,
            'shipping_fee_unit_price_cost' => $request->shipping_fee_unit_price_cost,
            'shipping_fee_note' => $request->shipping_fee_note,
        ]);
        return;
    }
}