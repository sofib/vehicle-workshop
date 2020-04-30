<?php

namespace SofiB\Delivery\Console;

use SofiB\Business\VehicleService;
use SofiB\Business\Vehicle\Vehicle;

class WashCommand extends VehicleCommand
{
    protected static $defaultName = 'wash';

    public function configure()
    {
        parent::configure();
        $this->setDescription('Washes a vehicle. Use \'cli help ' . self::$defaultName . '\' for more info.');
    }
    protected function vehicleAction(Vehicle $vehicle, VehicleService $service): float
    {
        return $service->wash($vehicle);
    }
}
