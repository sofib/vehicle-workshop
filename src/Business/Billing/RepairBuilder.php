<?php
namespace SofiB\Business\Billing;

use SofiB\Business\Billing\RepairElement\Part\Motor;
use SofiB\Business\Billing\RepairElement\Part\Part;

class RepairBuilder implements Builder
{
    /**
     * @var Part[] $elements
     */
    private $elements;

    public function __construct()
    {
        $this->elements = [];
    }


    public function withMotorService(Motor $motor) : RepairBuilder
    {
        $this->elements[] = $motor;
        return $this;
    }

    public function motorGeneric (float $cost) : Motor
    {
      return Motor::create('Generic', 1.0, $cost);
    }

    #public function withGlass() : RepairBuilder

    public function build () : Specs
    {
        $specs = new Specs();
        foreach($this->elements as $element) {
          $specs->add($element->getName(), $element->getQuantity(), $element->getUnitPrice(), $element->getUnitOfMeasure(), new \DateTimeImmutable());
        }

        return $specs;
    }
}
