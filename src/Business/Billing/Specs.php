<?php

namespace SofiB\Business\Billing;

class Specs
{
    private $chargable = [];
    public function __construct ()
    {

    }

    public function add(string $name, float $qty, float $unitCost, string $unit, \DateTimeInterface $time)
    {
        $this->chargable[] = (object) [
          'name' => $name,
          'quantity' => $qty,
          'unit' => $unit,
          'unitCost' => $unitCost,
          'time' => $time
        ];
    }
}
