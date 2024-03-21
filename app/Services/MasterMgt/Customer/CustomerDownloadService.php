<?php

namespace App\Services\MasterMgt\Customer;

// モデル
use App\Models\Customer;
// その他
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\CarbonImmutable;

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
            // システムに定義してあるヘッダーを取得し、書き込む
            $header = Customer::csvHeader();
            fputcsv($handle, $header);
            // レコードをチャンクごとに書き込む
            $customers->chunk($chunkSize, function ($customers) use ($handle) {
                // 荷主の分だけループ
                foreach($customers as $customer){
                    $row = [
                        $customer->customer_id,
                        $customer->dbs_base->base_name,
                        $customer->customer_name,
                        $customer->is_available,
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