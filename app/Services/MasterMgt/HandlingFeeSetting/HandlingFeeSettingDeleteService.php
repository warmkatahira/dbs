<?php

namespace App\Services\MasterMgt\HandlingFeeSetting;

// モデル
use App\Models\CustomerHandling;

class HandlingFeeSettingDeleteService
{
    public function deleteCustomerHandling($customer_handling_id)
    {
        // 削除
        CustomerHandling::where('customer_handling_id', $customer_handling_id)->delete();
        return;
    }
}