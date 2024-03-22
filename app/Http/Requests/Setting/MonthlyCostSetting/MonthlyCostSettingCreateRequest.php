<?php

namespace App\Http\Requests\Setting\MonthlyCostSetting;

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
            'ho_cost' => 'required|integer|min:0',
            'monthly_cost' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'required' => ":attributeを入力して下さい。",
            'date' => ":attributeは日付で入力して下さい。",
            'min' => ":attributeは:min文字以上で入力して下さい。",
            'integer' => ':attributeは数値で入力して下さい。',
        ];
    }

    public function attributes()
    {
        return [
            'monthly_cost_setting_ym' => '月額経費年月',
            'ho_cost' => '本社管理費',
            'monthly_cost' => '月額経費',
        ];
    }
}
