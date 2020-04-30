<?php

namespace SofiB\Business\Billing\RepairElement;

use SofiB\Business\Billing\RepairElement\Discount\Amount;
use SofiB\Business\Billing\RepairElement\Discount\DiscountList;

class Manpower implements Cost, Discountable
{
    private $workHours;
    private $pricePerHour;
    private $description;
    private $discounts;

    public function __construct(float $workHours, float $pricePerHours, string $description)
    {
        $this->workHours = $workHours;
        $this->pricePerHour = $pricePerHours;
        $this->description = $description;
        $this->discounts = new DiscountList();
    }

    public function getCost(): float
    {
        $regularPrice = $this->pricePerHour * $this->workHours;
        return $regularPrice - $this->calculateDiscount();
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function addDiscount(float $discountAmount, string $description): void
    {
        $this->discounts->add(new Amount($discountAmount, $description));
    }

    private function calculateDiscount() : float
    {
        $sum = 0;
        foreach ($this->discounts as $amount) {
            $sum += $amount->getAmount();
        }

        return $sum;
    }
}
