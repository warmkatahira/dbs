<?php

namespace App\Rules\MonthlyCost;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
// モデル
use App\Models\MonthlyCost;
use App\Models\MonthlyItem;
// その他
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;

class MonthlyCostYmCreateRule implements ValidationRule, DataAwareRule
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
        $monthly_cost_ym = CarbonImmutable::createFromFormat('Y-m', $this->data['monthly_cost_ym'])->startOfMonth();
        // 追加しようとしている条件のレコードを取得
        $monthly_cost = MonthlyCost::where('base_id', Auth::user()->base_id)
                        ->where('monthly_cost_ym', $monthly_cost_ym)
                        ->where('monthly_cost_item_id', $this->data['monthly_cost_item_id'])
                        ->first();
        // レコードが取得されていれば追加できないのでエラーを返す
        if(!is_null($monthly_cost)){
            $monthly_item = MonthlyItem::getSpecify($this->data['monthly_cost_item_id'])->first();
            $fail(CarbonImmutable::parse($this->data['monthly_cost_ym'])->isoFormat('Y年MM月') . 'の「'.$monthly_item->monthly_item_name.'」は既に登録されています。');
        }
    }
}
