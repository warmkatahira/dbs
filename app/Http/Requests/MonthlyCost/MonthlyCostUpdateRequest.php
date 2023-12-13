<?php

namespace App\Http\Requests\MonthlyCost;

use Illuminate\Foundation\Http\FormRequest;

class MonthlyCostUpdateRequest extends FormRequest
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
            'monthly_cost' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'required' => ":attributeを入力して下さい。",
            'min' => ":attributeは:min文字以上で入力して下さい。",
            'integer' => ':attributeは数値で入力して下さい。',
        ];
    }

    public function attributes()
    {
        return [
            'monthly_cost' => '月額経費',
        ];
    }
}
