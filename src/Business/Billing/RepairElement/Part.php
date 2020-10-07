<?php

namespace SofiB\Business\Billing\RepairElement;

class Parts implements Cost, \IteratorAggregate
{
    private $elements;

    public function __construct ()
    {
        $this->elements = [];
    }

    public function getCost () : float
    {
        return 0;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }
}
