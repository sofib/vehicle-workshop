<?php

namespace SofiB\Business\Billing;

use SofiB\Business\Billing\WashingElement\Cost;
use SofiB\Business\Billing\WashingElement\Manpower;
use SofiB\Business\Billing\WashingElement\Water;

class Wash implements Service
{
    private $work = [];

    private $water = [];

    public function addWork(Manpower $work): void
    {
        $this->work[] = $work;
    }

    public function addWater(Water $water): void
    {
        $this->water[] = $water;
    }

    public static function createWaterUsage(float $liters): Water
    {
        return new Water($liters);
    }

    public static function createWork(float $hours): Manpower
    {
        return new Manpower($hours);
    }

    public function getCost(): float
    {
        return $this->calculateWork() + $this->calculateWater();
    }

    private function sumCosts(?float $value, Cost $cost): float
    {
        return $value + $cost->getCost();
    }

    private function calculateWork(): float
    {
        return array_reduce($this->work, [$this, 'sumCosts']);
    }

    private function calculateWater(): float
    {
        return array_reduce($this->water, [$this, 'sumCosts']);
    }

}
