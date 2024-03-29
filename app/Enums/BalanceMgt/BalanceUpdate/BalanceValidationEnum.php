<?php declare(strict_types=1);

namespace App\Enums\BalanceMgt\BalanceUpdate;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BalanceValidationEnum extends Enum
{
    // バリデーションルールを定義
    const RULES = [
        'balance_id' => 'required|exists:balances,balance_id',
        'note' => 'nullable|max:50',
    ];
    // バリデーションエラーメッセージを定義
    const MESSAGES = [
        'required' => ':attributeが入力されていません。',
        'max' => ':attributeは:max文字以下で入力して下さい。',
        'exists' => ':attributeが存在しません。',
    ];
    // バリデーションエラー項目を定義
    const ATTRIBUTES = [
        'balance_id' => '収支',
        'note' => '収支備考',
    ];
}
