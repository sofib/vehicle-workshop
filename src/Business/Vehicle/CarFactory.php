<?php

namespace SofiB\Business\Vehicle;

class CarFactory implements VehicleFactory
{
    public function builder(): CarBuilder
    {
        return new CarBuilder();
    }
}
