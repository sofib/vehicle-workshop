<?php

namespace SofiB\Business\Vehicle;

class MotorcycleFactory implements VehicleFactory
{
    public function builder(): MotorcycleBuilder
    {
        return new MotorcycleBuilder();
    }
}
