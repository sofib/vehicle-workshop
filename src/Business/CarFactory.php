<?php

namespace SofiB\Business;

use SofiB\Business\Vehicle\Car;
use SofiB\Business\Vehicle\Vehicle;

class CarFactory implements VehicleFactory
{
    public function new(): Vehicle
    {
        return new Car();
    }
}
