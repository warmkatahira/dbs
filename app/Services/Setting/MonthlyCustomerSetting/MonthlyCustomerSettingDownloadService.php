<?php

namespace App\Services\Setting\MonthlyCustomerSetting;

// モデル
use App\Models\MonthlyCustomerSetting;
// その他
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\CarbonImmutable;

class MonthlyCustomerSettingDownloadService
{
    public function getDownloadMonthlyCustomerSetting($monthly_customer_settings)
    {
        // チャンクサイズを指定
        $chunkSize = 500;
        $response = new StreamedResponse(function () use ($monthly_customer_settings, $chunkSize) {
            // ハンドルを取得
            $handle = fopen('php://output', 'wb');
            // BOMを書き込む
            fwrite($handle, "\xEF\xBB\xBF");
            // システムに定義してあるヘッダーを取得し、書き込む
            $header = MonthlyCustomerSetting::csvHeader();
            fputcsv($handle, $header);
            // レコードをチャンクごとに書き込む
            $monthly_customer_settings->chunk($chunkSize, function ($monthly_customer_settings) use ($handle) {
                // 荷主の分だけループ
                foreach($monthly_customer_settings as $monthly_customer_setting){
                    $row = [
                        $monthly_customer_setting->monthly_customer_setting_id,
                        CarbonImmutable::parse($monthly_customer_setting->monthly_customer_setting_ym)->isoFormat('YYYY年MM月'),
                        $monthly_customer_setting->dbs_customer->dbs_base->base_name,
                        $monthly_customer_setting->dbs_customer->customer_name,
                        $monthly_customer_setting->monthly_storage_sales,
                        $monthly_customer_setting->monthly_storage_cost,
                        $monthly_customer_setting->ho_cost_allocation_ratio,
                        $monthly_customer_setting->monthly_cost_allocation_ratio,
                        $monthly_customer_setting->dbs_customer->is_available == 0 ? '無効' : '有効',
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