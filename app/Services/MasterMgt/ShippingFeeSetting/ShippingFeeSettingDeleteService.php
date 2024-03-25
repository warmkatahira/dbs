<?php

namespace App\Services\MasterMgt\ShippingFeeSetting;

// モデル
use App\Models\CustomerShippingMethod;

class ShippingFeeSettingDeleteService
{
    public function deleteCustomerShippingMethod($customer_shipping_method_id)
    {
        // 削除
        CustomerShippingMethod::where('customer_shipping_method_id', $customer_shipping_method_id)->delete();
        return;
    }
}