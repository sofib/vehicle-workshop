<?php

namespace SofiB\Business\Vehicle;

final class MotorcycleBuilder implements VehicleBuilder
{
    private ?VehicleIdentifier $id = null;
    private ?float $weight = null;
    private ?array $dimensions = null;
    private int $numberOfWheels = 2;

    public function withId(VehicleIdentifier $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withWeight(float $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function withDimensions(array $dimensions): self
    {
        $this->dimensions = $dimensions;
        return $this;
    }

    public function withWheels(int $numberOfWheels): self
    {
        $this->numberOfWheels = $numberOfWheels;
        return $this;
    }

    public function build(): Motorcycle
    {
        if ($this->weight === null || $this->dimensions === null) {
            throw new \InvalidArgumentException('Weight and dimenstions are required to build a motorcycle');
        }

        return new Motorcycle($this->weight, $this->dimensions, $this->numberOfWheels, $this->id);
    }
}