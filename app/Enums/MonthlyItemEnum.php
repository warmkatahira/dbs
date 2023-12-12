<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MonthlyItemEnum extends Enum
{
    const SALES_JP = '売上';
    const COST_JP = '経費';
}
