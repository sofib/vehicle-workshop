<?php

namespace SofiB\Business\Billing\WashingElement;

class Water implements Cost
{
    private const PRICE_PER_LITER = 0.15;
    private $amount;

    public function __construct(float $amountInLiters)
    {
        $this->amount = $amountInLiters;
    }

    public function getCost(): float
    {
        return (static::PRICE_PER_LITER * $this->amount);
    }
}
