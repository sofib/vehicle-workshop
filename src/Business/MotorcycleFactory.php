<?php

namespace SofiB\Business;

use SofiB\Business\Vehicle\Motorcycle;
use SofiB\Business\Vehicle\Vehicle;

class MotorcycleFactory implements VehicleFactory
{
    public function new(): Vehicle
    {
        return new Motorcycle();
    }
}
