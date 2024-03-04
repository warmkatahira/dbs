<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SortDirectionConditionsEnum extends Enum
{
    const ASC               = 'asc';
    const DESC              = 'desc';
    const ASC_JP            = '昇順';
    const DESC_JP           = '降順';
    // 検索条件の配列を作成
    public static function makeCondition()
    {
        // 配列を初期化
        $condition = [];
        // 配列に情報を格納
        $condition[self::ASC] = [
            'value' => self::ASC,
            'text' => self::ASC_JP,
        ];
        $condition[self::DESC] = [
            'value' => self::DESC,
            'text' => self::DESC_JP,
        ];
        return collect($condition);
    }
}
