<?php

namespace App\Http\Requests\MasterMgt\ShippingFeeSetting;

use Illuminate\Foundation\Http\FormRequest;

class ShippingFeeSettingUpdateRequest extends FormRequest
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
            'customer_shipping_method_id' => 'required|exists:customer_shipping_method,customer_shipping_method_id',
            'shipping_method_id' => 'required|exists:shipping_methods,shipping_method_id',
            'shipping_fee_unit_price_sales' => 'required|integer|min:0',
            'shipping_fee_unit_price_cost' => 'required|integer|min:0',
            'shipping_fee_note' => 'nullable|max:20',
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
            'customer_shipping_method_id' => '運賃設定',
            'shipping_method_id' => '配送方法',
            'shipping_fee_unit_price_sales' => '運賃単価(売上)',
            'shipping_fee_unit_price_cost' => '運賃単価(経費)',
            'shipping_fee_note' => '運賃備考',
        ];
    }
}
