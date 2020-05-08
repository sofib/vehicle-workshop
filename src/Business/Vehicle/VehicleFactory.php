<?php

namespace SofiB\Business\Vehicle;

interface VehicleFactory
{
    public function new(): Vehicle;
}
