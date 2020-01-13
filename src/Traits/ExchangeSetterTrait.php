<?php

declare(strict_types=1);

namespace GetPayPHP\Traits;

use GetPayPHP\Contracts\ShouldConvertCurrencies;

trait ExchangeSetterTrait
{
    /**
     * Undocumented variable.
     *
     * @var \GetPayPHP\Contracts\ShouldConvertCurrencies
     */
    protected $exchange;

    /**
     * Undocumented function.
     *
     * @return self
     */
    public function setCurrencyExchange(ShouldConvertCurrencies $exchange)
    {
        $this->exchange = $exchange;

        return $this;
    }
}
