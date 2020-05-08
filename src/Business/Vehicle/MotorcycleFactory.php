<?php

namespace SofiB\Business\Vehicle;

class MotorcycleFactory implements VehicleFactory
{
    public function new(): Vehicle
    {
        return new Motorcycle();
    }
}
