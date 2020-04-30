<?php

namespace SofiB\Business\Vehicle;

/**
 * Hardcoded values for simplicity.
 */
class Car implements Vehicle
{
  public function getWeight () : float {
    return 1500; //kg
  }

  public function getDimensions () : array {
    return [100, 200, 150]; //cm
  }

  public function toArray () : array {
    return [ 'weight' => $this->getWeight(), 'dimensions' => $this->getDimensions()];
  }
}
