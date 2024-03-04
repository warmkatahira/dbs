<?php declare(strict_types=1);

namespace App\Enums\BalanceMgt\BalanceList;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DispNumConditionsEnum extends Enum
{
    const DISP_03       = 3;
    const DISP_05       = 5;
    const DISP_10       = 10;
    const DISP_03_JP    = '3件';
    const DISP_05_JP    = '5件';
    const DISP_10_JP    = '10件';
    // 検索条件の配列を作成
    public static function makeCondition()
    {
        // 配列を初期化
        $condition = [];
        // 配列に情報を格納
        $condition[self::DISP_03] = [
            'value' => self::DISP_03,
            'text' => self::DISP_03_JP,
        ];
        $condition[self::DISP_05] = [
            'value' => self::DISP_05,
            'text' => self::DISP_05_JP,
        ];
        $condition[self::DISP_10] = [
            'value' => self::DISP_10,
            'text' => self::DISP_10_JP,
        ];
        return collect($condition);
    }
}
