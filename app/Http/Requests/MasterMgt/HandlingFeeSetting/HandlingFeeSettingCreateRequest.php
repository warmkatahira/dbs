<?php

namespace App\Http\Requests\MasterMgt\HandlingFeeSetting;

use Illuminate\Foundation\Http\FormRequest;

class HandlingFeeSettingCreateRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,customer_id',
            'handling_id' => 'required|exists:handlings,handling_id',
            'handling_fee_unit_price' => 'required|integer|min:0',
            'handling_fee_note' => 'nullable|max:20',
            'handling_fee_sort_order' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'required' => ":attributeを入力して下さい。",
            'min' => ":attributeは:min以上で入力して下さい。",
            'max' => ":attributeは:max文字以内で入力して下さい。",
            'integer' => ':attributeは数値で入力して下さい。',
            'exists' => ':attributeが存在しません。',
        ];
    }

    public function attributes()
    {
        return [
            'customer_id' => '荷主',
            'handling_id' => '荷役',
            'handling_fee_unit_price' => '荷役単価',
            'handling_fee_note' => '荷役備考',
            'handling_fee_sort_order' => '荷役並び順',
        ];
    }
}
