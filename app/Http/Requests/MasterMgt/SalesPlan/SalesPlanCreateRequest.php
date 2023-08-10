<?php

namespace App\Http\Requests\MasterMgt\SalesPlan;

use Illuminate\Foundation\Http\FormRequest;
// ルール
use App\Rules\MasterMgt\SalesPlan\SalesPlanYmCreateRule;

class SalesPlanCreateRequest extends FormRequest
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
            'sales_plan_ym' => ['required', 'date', new SalesPlanYmCreateRule],
            'sales_plan' => 'required|integer|min:0',
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
            'sales_plan_ym' => '売上計画年月',
            'sales_plan' => '売上計画',
        ];
    }
}
