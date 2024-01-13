<?php

namespace App\Services\MasterMgt\Customer;

// モデル
use App\Models\Customer;
// その他
use Symfony\Component\HttpFoundation\StreamedResponse;

class CustomerDownloadService
{
    public function getDownloadCustomer($customers)
    {
        // チャンクサイズを指定
        $chunkSize = 500;
        $response = new StreamedResponse(function () use ($customers, $chunkSize) {
            // ハンドルを取得
            $handle = fopen('php://output', 'wb');
            // BOMを書き込む
            fwrite($handle, "\xEF\xBB\xBF");
            // ヘッダー行を書き込む
            $headerRow = [
                '荷主ID',
                '拠点',
                '荷主名',
                '月間保管売上',
                '月間保管経費',
                '経費分配割合',
                '有効/無効',
            ];
            fputcsv($handle, $headerRow);
            // レコードをチャンクごとに書き込む
            $customers->chunk($chunkSize, function ($customers) use ($handle) {
                // 荷主の分だけループ
                foreach($customers as $customer){
                    $row = [
                        $customer->customer_id,
                        $customer->dbs_base->base_name,
                        $customer->customer_name,
                        $customer->monthly_storage_sales,
                        $customer->monthly_storage_cost,
                        $customer->cost_allocation_ratio,
                        $customer->is_available == 0 ? '無効' : '有効',
                    ];
                    fputcsv($handle, $row);
                };
            });
            // ファイルを閉じる
            fclose($handle);
        });
        return $response;
    }
}