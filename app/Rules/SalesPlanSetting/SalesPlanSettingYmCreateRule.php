<?php

namespace App\Rules\SalesPlanSetting;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
// モデル
use App\Models\SalesPlanSetting;
// その他
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;

class SalesPlanSettingYmCreateRule implements ValidationRule, DataAwareRule
{
    // エラーメッセージ格納用の変数をセット
    protected $error_message = '';
    // バリデーション下の全データを格納する配列をセット
    protected $data = [];

    // バリデーション下の全データをセット
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 1日の日付にフォーマット変換
        $sales_plan_setting_ym = CarbonImmutable::createFromFormat('Y-m', $this->data['sales_plan_setting_ym'])->startOfMonth();
        // 追加しようとしている条件のレコードを取得
        $sales_plan_setting = SalesPlanSetting::where('base_id', Auth::user()->base_id)
                        ->where('sales_plan_setting_ym', $sales_plan_setting_ym)
                        ->first();
        // レコードが取得されていれば追加できないのでエラーを返す
        if(!is_null($sales_plan_setting)){
            $fail(CarbonImmutable::parse($this->data['sales_plan_setting_ym'])->isoFormat('Y年MM月') . 'の:attributeは既に登録されています。');
        }
    }
}
