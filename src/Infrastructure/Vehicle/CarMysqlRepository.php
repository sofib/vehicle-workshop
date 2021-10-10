<?php

namespace SofiB\Infrastructure\Vehicle;

use SofiB\Business\Vehicle\CarFactory;
use SofiB\Business\Vehicle\VehicleIdentifierRelationalDatabase;

/**
 * @method CarFactory getFactory()
 */
class CarMysqlRepository extends VehicleMySqlRepository
{
    protected const VEHICLE_TYPE = 'car';

    protected function buildObject(array $row): \SofiB\Business\Vehicle\Car
    {
        return $this->getFactory()->builder()
                ->withId(new VehicleIdentifierRelationalDatabase($row['id']))
                ->withWeight((float) $row['weight'])
                ->withDimensions(json_decode($row['dimensions']))
                ->build();
    }
}
