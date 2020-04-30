<?php

namespace SofiB\Business\Billing;

use SofiB\Business\Billing\RepairElement\Discount\Amount as DiscountAmount;
use SofiB\Business\Billing\RepairElement\Manpower;

class Repair implements Service
{
    private $work = [];

    public function addWork(Manpower $work): void
    {
        $this->work[] = $work;
    }

    public static function createWork(float $hours, float $price, string $description = ''): Manpower
    {
        return new Manpower($hours, $price, $description);
    }

    public static function newDiscount(float $amount, string $description = ''): DiscountAmount
    {
        return new DiscountAmount($amount, $description);
    }

    public function getCost(): float
    {
        return array_reduce($this->work, function ($sum, Manpower $work) {
           return $sum + $work->getCost();
        });
    }
}
