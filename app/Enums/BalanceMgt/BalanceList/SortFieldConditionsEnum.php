<?php declare(strict_types=1);

namespace App\Enums\BalanceMgt\BalanceList;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SortFieldConditionsEnum extends Enum
{
    const SALES             = 'sales';
    const COST              = 'cost';
    const PROFIT            = 'profit';
    const SALES_JP          = '売上';
    const COST_JP           = '経費';
    const PROFIT_JP         = '利益';
    // 検索条件の配列を作成
    public static function makeCondition()
    {
        // 配列を初期化
        $condition = [];
        // 配列に情報を格納
        $condition[self::SALES] = [
            'value' => self::SALES,
            'text' => self::SALES_JP,
        ];
        $condition[self::COST] = [
            'value' => self::COST,
            'text' => self::COST_JP,
        ];
        $condition[self::PROFIT] = [
            'value' => self::PROFIT,
            'text' => self::PROFIT_JP,
        ];
        return collect($condition);
    }
}
