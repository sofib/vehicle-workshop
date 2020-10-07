<?php

namespace SofiB\Delivery\Console;

use SofiB\Business\VehicleRoot;

class RepairCommand extends VehicleCommand
{
    protected static $defaultName = 'repair';

    public function configure()
    {
        parent::configure();
        $this->setDescription('Repairs a vehicle. Use \'cli help ' . self::$defaultName . '\' for more info.');
    }

    protected function vehicleAction(VehicleRoot $vehicle): float
    {
        return $vehicle->service()->repair();
    }
}
