<?php declare(strict_types=1);

namespace App\Enums\BalanceMgt\BalanceUpdate;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BalanceMonthlyCostValidationEnum extends Enum
{
    // バリデーションルールを定義
    const RULES = [
        'ho_cost' => 'required|integer|min:0',
        'monthly_cost' => 'required|integer|min:0',
    ];
    // バリデーションエラーメッセージを定義
    const MESSAGES = [
        'required' => ':attributeが入力されていません。',
        'min' => ':attributeは:min以上で入力して下さい。',
        'integer' => ':attributeは整数で入力して下さい。',
    ];
    // バリデーションエラー項目を定義
    const ATTRIBUTES = [
        'ho_cost' => '本社管理費',
        'monthly_cost' => '月額経費',
    ];
}
