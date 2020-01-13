<?php

declare(strict_types=1);

namespace GetPayPHP\Services;

use GetPayPHP\Contracts\ShouldComputeCommissions;
use GetPayPHP\Traits\ExchangeSetterTrait;
use GetPayPHP\Transformers\Collection;

class Commission implements ShouldComputeCommissions
{
    use ExchangeSetterTrait;

    /**
     * Undocumented variable.
     *
     * @var array
     */
    protected $operators = [
        'cash_in'  => Operators\CashIn::class,
        'cash_out' => Operators\CashOutPartOne::class,
    ];

    /**
     * Undocumented function.
     *
     * @return self
     */
    public function setOperators(array $operators = [])
    {
        $this->operators = $operators;

        return $this;
    }

    /**
     * Undocumented function.
     *
     * @return string|float
     */
    public function compute(Collection $collection)
    {
        $class    = $this->operators[$collection->transactionType()];
        $operator = new $class($collection);
        $operator->setCurrencyExchange($this->exchange);
        $amount = $operator->fee();

        $collection->setValue('rawFee', $amount);
        $collection->setValue('roundUpFee', Math::roundUp($amount));
        $collection->setValue('convertedFee',
            Math::roundUp(
                $this->exchange->convert(
                    $collection->currency(),
                    $amount
                )
            )
        );

        return $amount;
    }
}
