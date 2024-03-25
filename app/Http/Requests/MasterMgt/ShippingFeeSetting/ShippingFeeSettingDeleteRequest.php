<?php

namespace App\Http\Requests\MasterMgt\ShippingFeeSetting;

use Illuminate\Foundation\Http\FormRequest;

class ShippingFeeSettingDeleteRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'required' => ":attributeを入力して下さい。",
            'exists' => ':attributeが存在しません。',
        ];
    }

    public function attributes()
    {
        return [
            'customer_shipping_method_id' => '運賃設定',
        ];
    }
}
