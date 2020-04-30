<?php

namespace SofiB\Business\Billing\WashingElement;

class Manpower implements Cost
{
    private const PRICE_PER_MINUTE = 20/60;

    private $workMinutes;

    public function __construct(float $workMinutes)
    {
        $this->workMinutes = $workMinutes;
    }

    public function getCost(): float
    {
        return static::PRICE_PER_MINUTE * $this->workMinutes;
    }
}
