<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BooleanEnum extends Enum
{
    const NOT_AVAILABLE     = 0;
    const AVAILABLE         = 1;
    const NOT_AVAILABLE_JP  = '無効';
    const AVAILABLE_JP      = '有効';
    // 検索条件の配列を作成
    public static function makeCondition()
    {
        // 配列を初期化
        $condition = [];
        // 配列に情報を格納
        $condition[self::NOT_AVAILABLE] = [
            'value' => self::NOT_AVAILABLE,
            'text' => self::NOT_AVAILABLE_JP,
        ];
        $condition[self::AVAILABLE] = [
            'value' => self::AVAILABLE,
            'text' => self::AVAILABLE_JP,
        ];
        return collect($condition);
    }
}
