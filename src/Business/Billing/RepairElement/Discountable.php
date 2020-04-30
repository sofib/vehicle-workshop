<?php

namespace SofiB\Business\Billing\RepairElement;

interface Discountable
{
    public function addDiscount(float $discountAmount, string $description): void;
}
