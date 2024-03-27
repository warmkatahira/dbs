<?php declare(strict_types=1);

namespace App\Enums\BalanceMgt\BalanceUpdate;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BalanceHandlingFeeValidationEnum extends Enum
{
    // バリデーションルールを定義
    const RULES = [
        'handling_id' => 'required|exists:handlings,handling_id',
        'handling_fee_quantity' => 'required|integer|min:0',
        'handling_fee_unit_price' => 'required|integer|min:0',
        'handling_fee_amount' => 'required|integer|min:0',
        'handling_fee_note' => 'nullable|max:20',
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
        'handling_id' => '荷役名',
        'handling_fee_quantity' => '荷役数',
        'handling_fee_unit_price' => '荷役単価',
        'handling_fee_amount' => '荷役金額',
        'handling_fee_note' => '荷役備考',
    ];
}
