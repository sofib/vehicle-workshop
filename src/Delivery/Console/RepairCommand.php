<?php

namespace SofiB\Delivery\Console;

use SofiB\Business\VehicleService;
use SofiB\Business\Vehicle\Vehicle;

class RepairCommand extends VehicleCommand
{
    protected static $defaultName = 'repair';

    public function configure()
    {
        parent::configure();
        $this->setDescription('Repairs a vehicle. Use \'cli help ' . self::$defaultName . '\' for more info.');
    }

    protected function vehicleAction(Vehicle $vehicle, VehicleService $service): float
    {
        return $service->repair($vehicle);
    }
}
