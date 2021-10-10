<?php

namespace SofiB\Infrastructure\Vehicle;

use SofiB\Business\Vehicle\MotorcycleFactory;
use SofiB\Business\Vehicle\VehicleIdentifierRelationalDatabase;

/**
 * @method MotorcycleFactory getFactory()
 */
class MotorcycleMysqlRepository extends VehicleMySqlRepository
{
    protected const VEHICLE_TYPE = 'motorcycle';

    protected function buildObject(array $row): \SofiB\Business\Vehicle\Motorcycle
    {
        return $this->getFactory()->builder()
                ->withId(new VehicleIdentifierRelationalDatabase($row['id']))
                ->withWeight((float) $row['weight'])
                ->withDimensions(json_decode($row['dimensions']))
                ->build();
    }
}
