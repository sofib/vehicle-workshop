<?php

namespace SofiB\Business\Vehicle;

class VehicleIdentifierRelationalDatabase implements VehicleIdentifier
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getValue(): int
    {
        return $this->id;
    }
}
