<?php

namespace SofiB\Business\Vehicle;

final class CarBuilder implements VehicleBuilder
{
    private ?VehicleIdentifier $id = null;
    private ?float $weight = null;
    private ?array $dimensions = null;

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

    public function build(): Car
    {
        if ($this->weight === null || $this->dimensions === null) {
            throw new \InvalidArgumentException('Weight and dimenstions are required to build a car');
        }

        return new Car($this->weight, $this->dimensions, $this->id);
    }
}