<?php

declare(strict_types=1);

namespace GetPayPHP\Services\Operators;

use GetPayPHP\Services\Math;

/**
 * This is basically used only for Part 1 test.
 *
 */
class CashOutOld extends CashOut
{
    /**
     * Undocumented function.
     *
     * @return string
     */
    protected function feeForNatural()
    {
        $amount = $this->collection->amount();

        return Math::mul(
            $amount,
            Math::div(static::COMMISSION_FEE, 100)
        );
    }
}
