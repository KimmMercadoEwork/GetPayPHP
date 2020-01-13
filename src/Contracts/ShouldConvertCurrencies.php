<?php

declare(strict_types=1);

namespace GetPayPHP\Contracts;

interface ShouldConvertCurrencies
{
    /**
     * Undocumented function.
     *
     * @param string    $currency
     * @param int|float $value
     *
     * @return string|float
     */
    public function convert($currency, $value);
}
