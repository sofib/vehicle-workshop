<?php

namespace SofiB\Business;

use SofiB\Business\Vehicle\Vehicle;

interface VehicleFactory
{
    public function new(): Vehicle;
}
