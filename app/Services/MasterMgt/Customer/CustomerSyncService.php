<?php

namespace App\Services\MasterMgt\Customer;

// モデル
use App\Models\Customer;
use App\Models\KintaiCustomer;

class CustomerSyncService
{
    // DB:kintaiのcustomersテーブルと同期
    public function syncCustomer()
    {
        // DB:kintaiのcustomersテーブルを全て取得
        $kintai_customers = KintaiCustomer::getAll()->get();
        // 追加用の配列を初期化
        $param = [];
        // レコードの分だけループ
        foreach($kintai_customers as $customer){
            // 追加する内容を配列にセット
            $param[] = [
                'customer_id' => $customer->customer_id,
                'base_id' => $customer->base_id,
                'customer_name' => $customer->customer_name,
                'is_available' => $customer->is_available,
                'customer_sort_order' => $customer->customer_sort_order,
            ];
        }
        // テーブルへ追加(upsertなので、存在しないレコードは追加され、存在するレコードは更新される)
        Customer::upsert($param, 'customer_id');
        return;
    }
}