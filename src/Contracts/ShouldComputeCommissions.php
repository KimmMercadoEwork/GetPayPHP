<?php

declare(strict_types=1);

namespace GetPayPHP\Contracts;

use GetPayPHP\Transformers\Collection;

interface ShouldComputeCommissions
{
    /**
     * Undocumented function.
     *
     * @return string|float
     */
    public function compute(Collection $collection);
}
