<?php

declare(strict_types=1);

namespace GetPayPHP\Services;

use Exception;
use GetPayPHP\Contracts\ShouldConvertCurrencies;

class CurrencyExchange implements ShouldConvertCurrencies
{
    /**
     * Override this method if you want to use API to
     * fetch latest exchange rate!
     */
    public function getLatestExchange(string $currency)
    {
        $exchange = [
            'EUR' => '1',
            'USD' => '1.1497',
            'JPY' => '129.53',
        ];

        if (!isset($exchange[$currency])) {
            throw new Exception("We currently don't support [$currency] this type of currency.");
        }

        return $exchange[$currency];
    }

    /**
     * Undocumented function.
     *
     * @param string $currency
     * @param mixed  $value
     *
     * @return string
     */
    public function convert($currency, $value)
    {
        $latestExchange = $this->getLatestExchange($currency);

        return Math::div(
            (string) $value,
            $latestExchange
        );
    }

    public function convertBack($currency, $value)
    {
        $latestExchange = $this->getLatestExchange($currency);

        return Math::mul(
            (string) $value,
            $latestExchange
        );
    }
}
