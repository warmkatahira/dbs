<?php

namespace App\Http\Requests\MonthlyCostSetting;

use Illuminate\Foundation\Http\FormRequest;
// ルール
use App\Rules\MonthlyCostSetting\MonthlyCostSettingYmCreateRule;

class MonthlyCostSettingCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'monthly_cost_setting_ym' => ['required', 'date', new MonthlyCostSettingYmCreateRule],
            'monthly_cost_setting_item_id' => 'required|exists:monthly_items,monthly_item_id',
            'monthly_cost_setting' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'required' => ":attributeを入力して下さい。",
            'date' => ":attributeは日付で入力して下さい。",
            'min' => ":attributeは:min文字以上で入力して下さい。",
            'integer' => ':attributeは数値で入力して下さい。',
            'exists' => ':attributeが存在しません。',
        ];
    }

    public function attributes()
    {
        return [
            'monthly_cost_setting_ym' => '月額経費年月',
            'monthly_cost_setting_item_id' => '経費項目',
            'monthly_cost_setting' => '月額経費',
        ];
    }
}
