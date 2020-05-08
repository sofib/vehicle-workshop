<?php
namespace SofiB\Business;

use SofiB\Infrastructure\EventStream;

final class VehicleRoot
{
  private const CAR = 'car';
  private const MOTOR = 'motor';

  private const SUPPORTED_VEHICLES = [self::CAR, self::MOTOR];

  /**
   * @var VehicleFactory[]
   */
  private static $vehicleFactoryMap = [
    self::CAR => Vehicle\CarFactory::class,
    self::MOTOR => Vehicle\MotorcycleFactory::class
  ];

  private $serviceInstance;

  public function service () : VehicleService 
  {
    return $this->serviceInstance;
  }

  public static function getValidVehicleTypes () : array 
  {
    return static::SUPPORTED_VEHICLES;
  }

  private function __construct (VehicleService $service)
  {
    $this->serviceInstance = $service;
  }

  public static function serveVehicle (Vehicle\Vehicle $vehicle, EventStream $stream) : VehicleRoot
  {
    return new VehicleRoot(new VehicleService($vehicle, $stream));
  }

  public static function createVehicleFromType (string $type): Vehicle\Vehicle
  {
    if (!in_array($type, static::SUPPORTED_VEHICLES)) {
      return null;
    }
    $factory = new static::$vehicleFactoryMap[$type];
    return $factory->new();
  }
}
