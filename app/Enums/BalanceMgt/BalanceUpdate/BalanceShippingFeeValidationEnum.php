<?php declare(strict_types=1);

namespace App\Enums\BalanceMgt\BalanceUpdate;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BalanceShippingFeeValidationEnum extends Enum
{
    // バリデーションルールを定義
    const RULES = [
        'shipping_method_id' => 'required|exists:shipping_methods,shipping_method_id',
        'shipping_fee_quantity_sales' => 'required|integer|min:0',
        'shipping_fee_unit_price_sales' => 'required|integer|min:0',
        'shipping_fee_amount_sales' => 'required|integer|min:0',
        'shipping_fee_quantity_cost' => 'required|integer|min:0',
        'shipping_fee_unit_price_cost' => 'required|integer|min:0',
        'shipping_fee_amount_cost' => 'required|integer|min:0',
        'shipping_fee_note' => 'nullable|max:20',
    ];
    // バリデーションエラーメッセージを定義
    const MESSAGES = [
        'required' => ':attributeが入力されていません。',
        'max' => ':attributeは:max文字以下で入力して下さい。',
        'min' => ':attributeは:min以上で入力して下さい。',
        'integer' => ':attributeは整数で入力して下さい。',
        'exists' => ':attributeが存在しません。',
    ];
    // バリデーションエラー項目を定義
    const ATTRIBUTES = [
        'shipping_method_id' => '配送方法',
        'shipping_fee_quantity_sales' => '個口数(売上)',
        'shipping_fee_unit_price_sales' => '運賃単価(売上)',
        'shipping_fee_amount_sales' => '運賃金額(売上)',
        'shipping_fee_quantity_cost' => '個口数(経費)',
        'shipping_fee_unit_price_cost' => '運賃単価(経費)',
        'shipping_fee_amount_cost' => '運賃金額(経費)',
        'shipping_fee_note' => '運賃備考',
    ];
}
