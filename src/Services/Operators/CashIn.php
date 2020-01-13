<?php

declare(strict_types=1);

namespace GetPayPHP\Services\Operators;

use GetPayPHP\Services\Math;
use GetPayPHP\Traits\ExchangeSetterTrait;
use GetPayPHP\Transformers\Collection;

class CashIn
{
    use ExchangeSetterTrait;

    const COMMISSION_FEE = '0.03';
    const MAX_FEE        = '5.00';

    /**
     * Undocumented variable.
     *
     * @var \GetPayPHP\Transformers\Collection
     */
    private $collection;

    /**
     * Undocumented function.
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Undocumented function.
     *
     * @return string
     */
    public function fee()
    {
        $amount = $this->exchange->convert(
            $this->collection->currency(),
            $this->collection->amount()
        );

        $fee = Math::mul(
            $amount,
            Math::div(static::COMMISSION_FEE, 100)
        );

        if ($fee >= static::MAX_FEE) {
            $fee = Math::add(static::MAX_FEE, 0);
        }

        return $fee;
    }
}
