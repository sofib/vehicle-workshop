<?php

namespace SofiB\Business\Vehicle;

class FactoryStrategy
{
    private array $factories;

    public function __construct()
    {
        $this->factories = [
            'car'        => new CarFactory(),
            'motorcycle' => new MotorcycleFactory(),
        ];
    }

    public function getFactory(string $type): ?VehicleFactory
    {
        return $this->factories[$type] ?? null;
    }
}