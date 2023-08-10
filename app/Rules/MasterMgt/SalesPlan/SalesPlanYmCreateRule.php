<?php

namespace App\Rules\MasterMgt\SalesPlan;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
// モデル
use App\Models\SalesPlan;
// その他
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;

class SalesPlanYmCreateRule implements ValidationRule, DataAwareRule
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
        $sales_plan_ym = CarbonImmutable::createFromFormat('Y-m', $this->data['sales_plan_ym'])->startOfMonth();
        // 追加しようとしている条件のレコードを取得
        $sales_plan = SalesPlan::where('base_id', Auth::user()->base_id)
                        ->where('sales_plan_ym', $sales_plan_ym)
                        ->first();
        // レコードが取得されていれば追加できないのでエラーを返す
        if(!is_null($sales_plan)){
            $fail(CarbonImmutable::parse($this->data['sales_plan_ym'])->isoFormat('Y年MM月') . 'の:attributeは既に登録されています。');
        }
    }
}
