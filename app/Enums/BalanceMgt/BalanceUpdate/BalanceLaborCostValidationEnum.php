<?php declare(strict_types=1);

namespace App\Enums\BalanceMgt\BalanceUpdate;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BalanceLaborCostValidationEnum extends Enum
{
    // バリデーションルールを定義
    const RULES = [
        'fulltime_labor_cost' => 'required|integer|min:0',
        'contract_labor_cost' => 'required|integer|min:0',
        'parttime_labor_cost' => 'required|integer|min:0',
    ];
    // バリデーションエラーメッセージを定義
    const MESSAGES = [
        'required' => ':attributeが入力されていません。',
        'min' => ':attributeは:min以上で入力して下さい。',
        'integer' => ':attributeは整数で入力して下さい。',
    ];
    // バリデーションエラー項目を定義
    const ATTRIBUTES = [
        'fulltime_labor_cost' => '正社員人件費',
        'contract_labor_cost' => '契約社員人件費',
        'parttime_labor_cost' => 'パート人件費',
    ];
}
