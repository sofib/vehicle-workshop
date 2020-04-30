<?php

namespace SofiB\Business\Billing\RepairElement\Discount;

class DiscountList implements \IteratorAggregate
{
    private $discounts = [];

    public function add(Amount $amount)
    {
        $this->discounts[] = $amount;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->discounts);
    }
}
