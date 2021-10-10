<?php

namespace SofiB\Business\Vehicle;

/**
 * Hardcoded values for simplicity.
 */
class Car implements Vehicle
{
  private ?VehicleIdentifier $id;
  private float $weight;
  private array $dimensions;
  private string $dimensionUnit = 'cm';
  private string $weightUnit = 'kg';

  public function __construct(float $weight, array $dimensions, ?VehicleIdentifier $id = null)
  {
    $this->id = $id;
    $this->weight = $weight;
    $this->dimensions = $dimensions;
  }

  public function getId(): ?VehicleIdentifier
  {
    return $this->id;
  }

  public function getWeight () : float {
    return $this->weight;
  }

  public function getDimensions () : array {
    return $this->dimensions; //cm
  }

  public function toArray () : array {
    return [ 'weight' => $this->getWeight(), 'dimensions' => $this->getDimensions()];
  }
}
