<?php

namespace SofiB\Business\Vehicle;

class CarFactory implements VehicleFactory
{
    public function new(): Vehicle
    {
        return new Car();
    }
}
