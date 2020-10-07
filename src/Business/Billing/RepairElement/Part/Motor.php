<?php

namespace SofiB\Business\Billing\RepairElement\Part;

class Motor implements Part
{
    private $name;
    private $quantity;
    private $unit;
    private $unitPrice;

    public function __construct (string $name, float $quantity, float $unitPrice, string $unit = 'piece')
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->unit = $unit;
        $this->unitPrice = $unitPrice;
    }

    public function getGroup () : string
    {
        return Group::MAIN;
    }

    public function getUnitOfMeasure () : string
    {
        return $this->unit;
    }

    public function getName () :  string
    {
        return $this->name;
    }

    public function getQuantity () : float
    {
        return $this->quantity;
    }

    public function getUnitPrice () :  float
    {
        return $this->getUnitPrice();
    }

    public static function create (string $name, float $quantity, float $unitPrice, string $unit = 'piece') : Motor
    {
        return new Motor($name, $quantity, $unitPrice, $unit);
    }
}
