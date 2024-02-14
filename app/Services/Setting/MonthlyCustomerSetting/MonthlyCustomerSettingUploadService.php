<?php

namespace App\Services\MonthlyCustomerSetting;

// モデル
use App\Models\MonthlyCustomerSetting;
// その他
use Illuminate\Support\Facades\Validator;

class MonthlyCustomerSettingUploadService
{
    // 選択したファイルをストレージに保存
    public function storeFile($file, $store_file_name)
    {
        // 選択したファイルのファイル名を取得
        $uploaded_file = $file->getClientOriginalName();
        // ストレージにファイルを保存して、パスを返す
        return $file->storeAs('public/import', $store_file_name);
    }

    // テーブルにアップロードしたデータを更新
    public function updateMonthlyCustomerSetting($items)
    {
        // バリデーションエラー情報を格納する配列をセット
        $validation_error = [];
        // バリデーションエラー出力ファイルのヘッダーを定義
        $validation_error_header = array('エラー行数', 'エラー内容');
        // データの分だけループ
        foreach($items as $key => $item){
            // バリデーション
            $message = $this->validation($item);
            // 変数が空でなければバリデーションエラーがあるので、配列にエラー情報を格納
            if(!empty($message)){
                // 変数にエラー情報を格納
                $validation_error[] = array_combine($validation_error_header, array(($key + 2).'行目', $message));
            }
            // 変数が空であればバリデーションエラーがないので、テーブルへの更新を実行
            if(empty($message)){
                MonthlyCustomerSetting::where('monthly_customer_setting_id', $item['monthly_customer_setting_id'])->update([
                    'monthly_storage_sales' => $item['monthly_storage_sales'],
                    'monthly_storage_cost' => $item['monthly_storage_cost'],
                    'ho_cost_allocation_ratio' => $item['ho_cost_allocation_ratio'],
                    'monthly_cost_allocation_ratio' => $item['monthly_cost_allocation_ratio'],
                ]);
            }
        }
        return $validation_error;
    }

    // アップロードしたデータをバリデーション
    public function validation($item)
    {
        // コレクションを配列に変換
        $itemArray = $item->toArray();
        // バリデーションルールを定義
        $rules = [
            'monthly_customer_setting_id' => 'required|exists:monthly_customer_settings,monthly_customer_setting_id',
            'monthly_storage_sales' => 'required|integer|min:0',
            'monthly_storage_cost' => 'required|integer|min:0',
            'ho_cost_allocation_ratio' => 'required|integer|min:0|max:100',
            'monthly_cost_allocation_ratio' => 'required|integer|min:0|max:100',
        ];
        // バリデーションエラーメッセージを定義
        $messages = [
            'required' => ":attributeは必須です。",
            'exists' => ':attributeが存在しません。',
            'integer' => ':attributeは整数で設定して下さい。',
            'min' => ':attributeは:min以上で設定して下さい。',
            'max' => ':attributeは:max以下で設定して下さい。',
        ];
        // バリデーションエラー項目を定義
        $attributes = [
            'monthly_customer_setting_id' => '月額荷主設定ID',
            'monthly_storage_sales' => '月額保管売上',
            'monthly_storage_cost' => '月額保管経費',
            'ho_cost_allocation_ratio' => '本社管理費分配割合',
            'monthly_cost_allocation_ratio' => '月額経費分配割合',
        ];
        // バリデーション実施
        $validator = Validator::make($itemArray, $rules, $messages, $attributes);
        // バリデーションエラーメッセージを格納する変数をセット
        $message = '';
        // バリデーションエラーの分だけループ
        foreach($validator->errors()->toArray() as $errors){
            // メッセージを格納
            $message = empty($message) ? array_shift($errors) : $message . ' / ' . array_shift($errors);
        }
        return $message;
    }
}