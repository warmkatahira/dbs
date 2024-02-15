<?php

namespace App\Services\Setting\MonthlyCustomerSetting;

// その他
use Symfony\Component\HttpFoundation\StreamedResponse;

class MonthlyCustomerSettingUploadErrorDownloadService
{
    public function getDownloadMonthlyCustomerSettingUploadError($errors)
    {
        $response = new StreamedResponse(function () use ($errors) {
            // ハンドルを取得
            $handle = fopen('php://output', 'wb');
            // BOMを書き込む
            fwrite($handle, "\xEF\xBB\xBF");
            // ヘッダーを書き込む
            $header = array('エラー行数', 'エラー内容');
            fputcsv($handle, $header);
            // エラーの分だけループ
            foreach($errors as $error){
                $row = [
                    $error['エラー行数'],
                    $error['エラー内容'],
                ];
                fputcsv($handle, $row);
            };
            // ファイルを閉じる
            fclose($handle);
        });
        return $response;
    }
}