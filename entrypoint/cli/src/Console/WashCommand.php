<?php

namespace SofiB\Delivery\Console;

use SofiB\Business\VehicleRoot;

class WashCommand extends VehicleCommand
{
    protected static $defaultName = 'wash';

    public function configure()
    {
        parent::configure();
        $this->setDescription('Washes a vehicle. Use \'cli help ' . self::$defaultName . '\' for more info.');
    }

    protected function vehicleAction(VehicleRoot $vehicle): float
    {
        return $vehicle->service()->wash();
    }
}
